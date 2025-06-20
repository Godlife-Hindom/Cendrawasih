<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Str;
use Illuminate\Support\Facades\Schema;
use App\Models\Criteria;
use App\Models\Alternative;
use App\Models\Subcriteria;
use Illuminate\Http\Request;

class UserAlternativeController extends Controller
{
    public function index()
    {
        $alternatives = auth()->user()->alternatives;
        return view('user.my-alternatives', compact('alternatives'));
    }

    public function create()
    {
        return view('user.add-alternative');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'vegetation' => 'required|numeric',
            'water' => 'required|numeric',
            'topography' => 'required|numeric',
            'climate' => 'required|numeric',
        ]);
        
        auth()->user()->alternatives()->create([
            'name' => $request->name,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'vegetation' => $request->vegetation,
            'water' => $request->water,
            'topography' => $request->topography,
            'climate' => $request->climate,
        ]);
        

        return redirect()->route('user.alternatives.index')->with('success', 'Lokasi berhasil disimpan.');
    }

    public function calculate()
{
    $user = auth()->user();
    $alternatives = $user->alternatives;
    $criterias = Criteria::all()->keyBy('name');
    $subcriteriaData = Subcriteria::all()->groupBy('criteria_id');

    $scored = [];

    \Log::info("=== [ARAS CALCULATION STARTED] ===");

    // Step 1: Konversi nilai mentah ke skor
    foreach ($alternatives as $alt) {
        $row = [
            'id' => $alt->id,
            'name' => $alt->name,
        ];

        \Log::info("🔍 Alternative: {$alt->name} (ID: {$alt->id})");

        foreach ($criterias as $kriteriaName => $kriteriaObj) {
            $columnName = strtolower($kriteriaName); // sesuaikan dengan nama kolom
            $nilai = $alt->$columnName;

            \Log::info("  ➤ {$kriteriaName}: Nilai mentah = {$nilai}");

            $subs = $subcriteriaData[$kriteriaObj->id] ?? collect();
            $score = $this->getScoreFromSubcriteria($nilai, $subs, $alt->id, $kriteriaName);

            \Log::info("     🔸 Skor subkriteria = {$score}");

            $row[$kriteriaName . '_skor'] = $score;
        }

        $scored[] = $row;
    }

    // Step 2: Normalisasi
    foreach ($criterias as $kriteriaName => $kriteriaObj) {
        $max = collect($scored)->max($kriteriaName . '_skor');
        \Log::info("🧮 Max {$kriteriaName} skor: {$max}");

        foreach ($scored as &$row) {
            $normalized = ($max > 0) ? $row[$kriteriaName . '_skor'] / $max : 0;
            $row[$kriteriaName . '_norm'] = round($normalized, 6);

            \Log::info("  ➤ {$row['name']} - Normalisasi {$kriteriaName}: {$row[$kriteriaName . '_skor']} / {$max} = {$row[$kriteriaName . '_norm']}");
        }
    }

    // Step 3: Hitung K_i
    foreach ($scored as &$row) {
        $Ki = 0;
        \Log::info("📊 Pembobotan untuk {$row['name']}:");

        foreach ($criterias as $kriteriaName => $kriteriaObj) {
            $normalized = $row[$kriteriaName . '_norm'];
            $weighted = $normalized * $kriteriaObj->weight;
            $row[$kriteriaName . '_bobot'] = round($weighted, 6);
            $Ki += $weighted;

            \Log::info("  ➤ {$kriteriaName}: norm = {$normalized}, weight = {$kriteriaObj->weight}, bobot = {$weighted}");
        }

        $row['Ki'] = round($Ki, 6);
        \Log::info("  ✅ K_i (total skor) = {$row['Ki']}");
    }

    // Step 4: Ranking
    usort($scored, fn($a, $b) => $b['Ki'] <=> $a['Ki']);

    $rank = 1;
    foreach ($scored as &$row) {
        $row['peringkat'] = $rank++;

        $alt = Alternative::find($row['id']);
        $row['latitude'] = $alt->latitude;
        $row['longitude'] = $alt->longitude;
        $alt->score = $row['Ki'];
        $kategori = $this->getKategori($row['Ki']);
        $row['kategori'] = $kategori;
        $alt->save();

        \Log::info("🏅 {$row['name']} (ID: {$row['id']}), Skor Akhir: {$row['Ki']}, Peringkat: {$row['peringkat']}, Kategori: {$kategori}");
    }

    \Log::info("=== [ARAS CALCULATION COMPLETED] ===");

    session(['result' => $scored]);
    return redirect()->route('user.dashboard')->with('success', 'Perhitungan ARAS berhasil dilakukan.');
}


    
public function getScoreFromSubcriteria($value, $subs, $altId, $kriteriaName)
{
    foreach ($subs as $sub) {
        $rawRange = trim($sub->range);
        \Log::info("RAW RANGE INPUT: \"{$rawRange}\"");

        $range = trim($rawRange);

        // Format: 0.30 - 0.49 atau -0.40 - -0.20
        if (preg_match('/^(-?\d+\.?\d*)\s*-\s*(-?\d+\.?\d*)$/', $range, $matches)) {
            $min = (float)$matches[1];
            $max = (float)$matches[2];

            if ($value >= $min && $value <= $max) {
                \Log::info("Match alternatif {$altId} kriteria {$kriteriaName} ({$value}) dengan range '{$rawRange}', score: {$sub->score}");
                return $sub->score;
            }
        }

        // Format: > 3000
        elseif (\Str::startsWith($range, '>')) {
            $min = (float)trim(str_replace('>', '', $range));
            if ($value > $min) {
                \Log::info("Match alternatif {$altId} kriteria {$kriteriaName} ({$value}) dengan range '{$rawRange}', score: {$sub->score}");
                return $sub->score;
            }
        }

        // Format: < 3000
        elseif (\Str::startsWith($range, '<')) {
            $max = (float)trim(str_replace('<', '', $range));
            if ($value < $max) {
                \Log::info("Match alternatif {$altId} kriteria {$kriteriaName} ({$value}) dengan range '{$rawRange}', score: {$sub->score}");
                return $sub->score;
            }
        }
    }

    \Log::info("Tidak ditemukan match alternatif {$altId} kriteria {$kriteriaName} ({$value}), return score: 0");
    return 0;
}




public function normalizeDecisionMatrix($alternatives)
{
    $criteria = Criteria::all();
    $matrix = [];

    foreach ($alternatives as $alt) {
        $row = [];
        foreach ($criteria as $c) {
            $value = $alt[$c->name];
            $score = $this->getSubcriteriaScore($value, $c->id);
            $row[] = $score;
        }
        $matrix[] = $row;
    }

    return $matrix;
}



    private function getKategori($score)
    {
        if ($score >= 0.8) return 'Sangat Baik';
        elseif ($score >= 0.6) return 'Baik';
        elseif ($score >= 0.4) return 'Cukup';
        elseif ($score >= 0.2) return 'Kurang';
        else return 'Buruk';
    }


public function edit(Alternative $alternative)
{
    return view('user.edit', compact('alternative'));
}

public function update(Request $request, Alternative $alternative)
{
    $alternative->update($request->all());
    return redirect()->route('user.alternatives.index')->with('success', 'Alternatif berhasil diperbarui!');

}

public function destroy(Alternative $alternative)
{
    $alternative->delete();
    return redirect()->route('user.alternatives.index')->with('success', 'Alternatif dihapus.');

}

}
