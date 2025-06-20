<?php

namespace App\Services;

use App\Models\Criteria;
use App\Models\Subcriteria;
use App\Models\Alternative;

class ARASService
{
    public function calculate(array $alternatives, array $weights)
    {
        $criterias = Criteria::all()->keyBy('name');
        $subcriteriaData = Subcriteria::all()->groupBy('criteria_id');
        $scored = [];

        // Step 1: Skoring berdasarkan subkriteria
        foreach ($alternatives as $alt) {
            $row = [
                'id' => $alt['id'],
                'name' => $alt['name'],
            ];

            foreach ($criterias as $kriteriaName => $kriteriaObj) {
                $columnName = strtolower($kriteriaName);
                $nilai = $alt[$columnName] ?? 0;

                $subs = $subcriteriaData[$kriteriaObj->id] ?? collect();
                $score = $this->getScoreFromSubcriteria($nilai, $subs);
                $row[$kriteriaName . '_skor'] = $score;
            }

            $scored[] = $row;
        }

        // Step 2: Normalisasi
        foreach ($criterias as $kriteriaName => $kriteriaObj) {
            $max = collect($scored)->max($kriteriaName . '_skor');
            foreach ($scored as &$row) {
                $normalized = ($max > 0) ? $row[$kriteriaName . '_skor'] / $max : 0;
                $row[$kriteriaName . '_norm'] = round($normalized, 6);
            }
        }

        // Step 3: Hitung skor akhir
        foreach ($scored as &$row) {
            $Ki = 0;
            foreach ($criterias as $kriteriaName => $kriteriaObj) {
                $normalized = $row[$kriteriaName . '_norm'];
                $bobot = $weights[strtolower($kriteriaName)] ?? 0;
                $weighted = $normalized * $bobot;
                $row[$kriteriaName . '_bobot'] = round($weighted, 6);
                $Ki += $weighted;
            }
            $row['score'] = round($Ki, 6);
        }

        // Step 4: Ranking dan penambahan data lokasi
        usort($scored, fn($a, $b) => $b['score'] <=> $a['score']);

        $rank = 1;
        foreach ($scored as &$row) {
            $alt = Alternative::find($row['id']);
            $row['peringkat'] = $rank++;
            $row['latitude'] = $alt->latitude;
            $row['longitude'] = $alt->longitude;
            $row['kategori'] = $this->getKategori($row['score']);
        }

        return array_slice($scored, 0, 5);
    }

    private function getScoreFromSubcriteria($value, $subs)
    {
        foreach ($subs as $sub) {
            $range = trim($sub->range);

            if (preg_match('/^(-?\d+\.?\d*)\s*-\s*(-?\d+\.?\d*)$/', $range, $matches)) {
                $min = (float)$matches[1];
                $max = (float)$matches[2];
                if ($value >= $min && $value <= $max) return $sub->score;
            } elseif (\Str::startsWith($range, '>')) {
                $min = (float)trim(str_replace('>', '', $range));
                if ($value > $min) return $sub->score;
            } elseif (\Str::startsWith($range, '<')) {
                $max = (float)trim(str_replace('<', '', $range));
                if ($value < $max) return $sub->score;
            }
        }

        return 0;
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
