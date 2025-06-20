<?php

namespace App\Http\Controllers;

use App\Models\Alternative;
use App\Models\Criteria;
use App\Services\ARASService;

class ARASController extends Controller
{
    public function calculate()
{
    $alternatives = Alternative::all()->toArray();
    $criteria = Criteria::all();
    $weights = [];

    foreach ($criteria as $c) {
        $weights[strtolower($c->name)] = $c->weight;
    }

    // Hitung hasil ARAS
    $result = (new ARASService())->calculate($alternatives, $weights);

    // Format ulang result untuk map
    $results = [];
    foreach ($result as $row) {
        $entry = [
            'id' => $row['id'],
            'name' => $row['name'],
            'latitude' => $row['latitude'],
            'longitude' => $row['longitude'],
            'score' => round($row['score'], 4),
            'kategori' => $row['kategori'] ?? $this->getKategori($row['score']),
        ];

        $results[] = $entry;

        // Tambahkan log untuk setiap entry
        \Log::info('🗺️ Data lokasi untuk map:', $entry);
    }

    // Log jumlah total yang dikirim
    \Log::info('✅ Total data lokasi yang dikirim ke map:', ['total' => count($results)]);

    return view('map', [
        'result' => $result, // data lengkap
        'results' => $results // data ringkas untuk peta
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
}
