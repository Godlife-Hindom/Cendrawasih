<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Subcriteria;

class ParseSubcriteriaRange extends Command
{
    protected $signature = 'subcriteria:parse-range';
    protected $description = 'Parse kolom range ke dalam min_value dan max_value';

    public function handle()
{
    $subcriterias = Subcriteria::all();

    foreach ($subcriterias as $sub) {
        $parsed = $this->parseRange($sub->range);

        $this->info("ID: {$sub->id} | Name: {$sub->name}");
        $this->line("  Range: {$sub->range}");
        $this->line("  Min: " . ($parsed['min'] ?? 'null'));
        $this->line("  Max: " . ($parsed['max'] ?? 'null'));
        $this->line('-----------------------------');
    }

    return 0;
}

private function parseRange($range)
{
    $range = trim($range);
    $min = null;
    $max = null;

    // Normalize symbols
    $range = str_replace(['≥', '≤'], ['>=', '<='], $range);

    // Format: "x - y", termasuk negatif
    if (preg_match('/^\s*(-?\d+(\.\d+)?)\s*-\s*(-?\d+(\.\d+)?)$/', $range, $match)) {
        $min = floatval($match[1]);
        $max = floatval($match[3]);
    }
    // Format: "> x"
    elseif (preg_match('/^>\s*(-?\d+(\.\d+)?)/', $range, $match)) {
        $min = floatval($match[1]) + 0.00001;
        $max = INF;
    }
    // Format: ">= x"
    elseif (preg_match('/^>=\s*(-?\d+(\.\d+)?)/', $range, $match)) {
        $min = floatval($match[1]);
        $max = INF;
    }
    // Format: "< x"
    elseif (preg_match('/^<\s*(-?\d+(\.\d+)?)/', $range, $match)) {
        $min = -INF;
        $max = floatval($match[1]) - 0.00001;
    }
    // Format: "<= x"
    elseif (preg_match('/^<=\s*(-?\d+(\.\d+)?)/', $range, $match)) {
        $min = -INF;
        $max = floatval($match[1]);
    }
    // Format: "= x"
    elseif (preg_match('/^=?\s*(-?\d+(\.\d+)?)/', $range, $match)) {
        $min = $max = floatval($match[1]);
    }

    return [
        'min' => $min,
        'max' => $max,
    ];
}

}
