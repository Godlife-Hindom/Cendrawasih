<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;

class UserMapController extends Controller
{
    public function index()
    {
        $result = session('result');

        if (!$result || empty($result)) {
            return redirect()->route('user.dashboard')->with('warning', 'Belum ada hasil perhitungan ARAS.');
        }

        // Ambil hanya data yang dibutuhkan
        $results = [];
        foreach ($result as $row) {
            $results[] = [
                'id' => $row['id'],
                'name' => $row['name'],
                'latitude' => $row['latitude'],
                'longitude' => $row['longitude'],
                'score' => round($row['Ki'], 4),
                'kategori' => $row['kategori'] ?? $this->getKategori($row['Ki']),
            ];
        }

        Log::info('Data yang dikirim ke view-map (filtered): ' . json_encode($results));

        return view('user.view-map', ['locations' => $results]);
    }

    // Tambahkan jika belum ada di controller ini
    private function getKategori($score)
    {
        if ($score >= 0.8) return 'Sangat Baik';
        elseif ($score >= 0.6) return 'Baik';
        elseif ($score >= 0.4) return 'Cukup';
        elseif ($score >= 0.2) return 'kurang';
        else return 'Buruk';
    }
}
