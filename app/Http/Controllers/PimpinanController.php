<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alternative;
use App\Models\User;
use App\Models\Report;
use App\Models\Criteria;
use App\Models\Subcriteria;
use App\Models\Laporan;
use App\Models\Feedback;
use App\Services\ARASService;

class PimpinanController extends Controller
{
    public function index(Request $request)
    {
        $userId = $request->input('user_id');
        $users = User::where('role', 'user')->get();

        $alternativeModels = Alternative::when($userId, function ($query) use ($userId) {
            return $query->where('user_id', $userId);
        })->with('user')->get();

        $alternatives = $alternativeModels->toArray();

        $criteria = Criteria::all();
        $subcriteria = Subcriteria::all();
        $laporan = Laporan::all();
        $report = Report::all();
        $weights = [];
        foreach ($criteria as $c) {
            $weights[strtolower($c->name)] = $c->weight;
        }

        $rawResults = count($alternatives) > 0
            ? (new ARASService())->calculate($alternatives, $weights)
            : [];

        $result = array_map(function ($item) use ($alternatives) {
            $alt = collect($alternatives)->firstWhere('id', $item['id']);
            return (object)[
                'id' => $item['id'],
                'name' => $alt['name'] ?? 'N/A',
                'user' => isset($alt['user']) ? (object) $alt['user'] : null,
                'score' => $item['score'],
                'peringkat' => $item['peringkat'] ?? null,
            ];
        }, $rawResults);

        $topAlternatives = array_slice($result, 0, 5);

        return view('pimpinan.dashboard', [
            'users' => $users,
            'topAlternatives' => $topAlternatives,
            'alternativesCount' => $alternativeModels->count(),
            'criteriaCount' => $criteria->count(),
            'subcriteriaCount' => $subcriteria->count(),
            'reportCount' => $report->count(),
            'laporanCount' => Laporan::count(),
            'laporan' => Report::where('user_id', $userId)->latest()->first(),
            'selectedUserId' => $userId,
        ]);
    }

    public function filter(Request $request)
    {
        return $this->index($request); // gunakan ulang logika dari index()
    }
    

    public function showMap(Request $request)
{
    $userId = $request->query('user_id');

    $alternativesQuery = Alternative::query();
    if ($userId) {
        $alternativesQuery->where('user_id', $userId);
    }

    $alternatives = $alternativesQuery->get()->toArray();

    $criteria = Criteria::all();
    $weights = [];
    foreach ($criteria as $c) {
        $weights[strtolower($c->name)] = $c->weight;
    }

    $rawResults = count($alternatives) > 0
        ? (new ARASService())->calculate($alternatives, $weights)
        : [];

    $result = array_map(function ($item) use ($alternatives) {
        $alt = collect($alternatives)->firstWhere('id', $item['id']);

        $kategori = $this->getKategori($item['score']);

        return [
            'id' => $item['id'],
            'name' => $alt['name'] ?? 'N/A',
            'latitude' => $alt['latitude'] ?? null,
            'longitude' => $alt['longitude'] ?? null,
            'score' => $item['score'],
            'peringkat' => $item['peringkat'] ?? null,
            'kategori' => $kategori,
        ];
    }, $rawResults);

    \Log::info('🗺️ Pimpinan membuka peta, hasil ARAS:', $result);

    $topAlternatives = array_slice($result, 0, 5);

    return view('pimpinan.peta', [
        'locations' => $topAlternatives, // ini harus 'locations'
        'selectedUserId' => $userId,
    ]);
}




    private function getKategori($score)
    {
        if ($score >= 0.8) return 'Sangat Baik';
        elseif ($score >= 0.6) return 'Baik';
        elseif ($score >= 0.4) return 'Cukup';
        elseif ($score >= 0.2) return 'Kurang';
        else return 'Buruk';
    }

    public function feedbackForm()
{
    return view('pimpinan.feedback');
}

public function submitFeedback(Request $request)
{
    $sus = $request->input('sus');

    // Validasi: pastikan semua pertanyaan dijawab
    if (!is_array($sus) || count($sus) < 10) {
        return redirect()->back()->with('error', 'Semua pertanyaan harus dijawab.');
    }

    // Hitung skor SUS
    $totalScore = 0;
    foreach ($sus as $index => $value) {
        $value = (int) $value;
        if (($index + 1) % 2 === 1) {
            $totalScore += $value - 1;
        } else {
            $totalScore += 5 - $value;
        }
    }
    $finalScore = $totalScore * 2.5;

    // Simpan ke tabel feedback
    Feedback::create([
        'user_id' => auth()->id(), // jika login
        'responses' => json_encode([
            'answers' => $sus,
            'score' => $finalScore
        ])
    ]);

    return redirect()->route('pimpinan.dashboard')->with('success', 'Terima kasih atas feedback Anda!');
}
}