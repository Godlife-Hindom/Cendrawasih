<?php

namespace App\Http\Controllers;

use App\Models\Alternative;
use App\Models\Criteria;
use App\Models\Subcriteria;
use App\Models\Laporan;
use App\Models\User;
use App\Services\ARASService;
use Illuminate\Http\Request;
use App\Models\Report;
use App\Models\Feedback;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $userId = $request->input('user_id');

        // Ambil alternatif berdasarkan user (jika ada)
        $alternativeModels = Alternative::when($userId, function ($query) use ($userId) {
            return $query->where('user_id', $userId);
        })->get();

        // Konversi ke array
        $alternatives = $alternativeModels->toArray();

        // Ambil semua kriteria
        $criteria = Criteria::all();
        $subcriteria = Subcriteria::all();
        $laporan = Laporan::all();
        $report = Report::all();
        $weights = [];
        foreach ($criteria as $c) {
            $weights[strtolower($c->name)] = $c->weight;
        }

        // Hitung ARAS jika ada data alternatif
        $rawResults = count($alternatives) > 0
            ? (new ARASService())->calculate($alternatives, $weights)
            : [];

        // Gabungkan hasil ARAS dengan info lokasi dari alternatif
        $result = array_map(function ($item) use ($alternatives) {
            $alt = collect($alternatives)->firstWhere('id', $item['id']);
            return [
                'id' => $item['id'],
                'name' => $alt['name'] ?? 'N/A',
                'latitude' => $alt['latitude'] ?? null,
                'longitude' => $alt['longitude'] ?? null,
                'score' => $item['score'],
                'peringkat' => $item['peringkat'] ?? null,
            ];
        }, $rawResults);

        // Simpan ke session supaya bisa ditampilkan setelah redirect
        session(['result' => $result]);

        $topAlternatives = array_slice($result, 0, 5);

        // Ambil semua user biasa untuk filter
        $users = User::where('role', 'user')->get();

        // Ambil hasil dari session untuk ditampilkan
        $resultFromSession = session('result', []);

        return view('dashboard', [
            'alternativesCount' => $alternativeModels->count(),
            'criteriaCount' => $criteria->count(),
            'subcriteriaCount' => $subcriteria->count(),
            'laporanCount' => $laporan->count(),
            'reportCount' => $report->count(),
            'topAlternatives' => $topAlternatives,
            'users' => $users,
            'selectedUserId' => $userId,
            'result' => $resultFromSession
        ]);
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

    // Log hasil untuk pengecekan
    \Log::info('🗺️ Admin membuka peta, hasil ARAS:', $result);

    $topAlternatives = array_slice($result, 0, 5);

    return view('map', [
        'result' => $topAlternatives,
        'selectedUserId' => $userId,
    ]);
}

// Tambahkan method ini di dalam controller jika belum ada
private function getKategori($score)
{
    if ($score >= 0.8) return 'Sangat Baik';
    elseif ($score >= 0.6) return 'Baik';
    elseif ($score >= 0.4) return 'Cukup';
    elseif ($score >= 0.2) return 'Kurang';
    else return 'Buruk';
}

    public function sendReport(Request $request)
{
    $request->validate([
        'user_id' => 'required|exists:users,id',
    ]);

    $userId = $request->user_id;

    // Ambil alternatif terbaik milik user terkait
    $alternatives = Alternative::where('user_id', $userId)->orderByDesc('score')->get();

    if ($alternatives->isEmpty()) {
        return back()->with('warning', 'Tidak ada data alternatif untuk user ini.');
    }

    // Buat laporan baru
    $report = new Report();
    $report->user_id = $userId;
    $report->sent_by = Auth::id(); // Admin yang mengirim
    $report->title = 'Laporan Hasil Alternatif';
    $report->content = 'Laporan dikirim ke pimpinan untuk ditinjau.';
    $report->approved = false;
    $report->save();

    // Lampirkan alternatif ke laporan
    foreach ($alternatives as $alt) {
        $report->alternatives()->attach($alt->id);
    }

    return back()->with('success', 'Laporan berhasil dikirim ke pimpinan.');
}
public function feedbackForm()
{
    return view('feedback.form'); // pastikan view ini ada
}

public function submitFeedback(Request $request)
{
    $sus = $request->input('sus');

    // Validasi: semua 10 pertanyaan harus dijawab
    if (!is_array($sus) || count($sus) < 10) {
        return redirect()->back()->with('error', 'Semua pertanyaan harus dijawab.');
    }

    // Hitung skor SUS
    $totalScore = 0;
    foreach ($sus as $index => $value) {
        $value = (int) $value;
        // Ganjil: (value - 1), Genap: (5 - value)
        if (($index + 1) % 2 === 1) {
            $totalScore += $value - 1;
        } else {
            $totalScore += 5 - $value;
        }
    }

    $finalScore = $totalScore * 2.5;

    // Simpan ke tabel feedback
    Feedback::create([
        'user_id' => auth()->id(),
        'responses' => json_encode([
            'answers' => $sus,
            'score' => $finalScore
        ]),
    ]);

    return redirect()->route('dashboard')->with('success', 'Terima kasih atas feedback Anda!');
}

public function destroy($id)
{
    $user = User::findOrFail($id);
    $user->delete();

    return redirect()->route('admin.users.index')->with('success', 'User berhasil dihapus.');
}
}