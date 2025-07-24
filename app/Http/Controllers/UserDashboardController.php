<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Report;
use App\Models\Alternative;
use App\Models\Criteria;
use App\Models\Subcriteria;

class UserDashboardController extends Controller
{
    public function index()
{
    $user = auth()->user();

    $alternatives = $user->alternatives ?? collect(); // fallback ke koleksi kosong
    $alternativesCount = $alternatives->count();
    $criteriaCount = Criteria::count();
    $subcriteriaCount = Subcriteria::count();
    $topAlternatives = $alternatives->sortByDesc('Ki')->take(5);

    $result = session('result'); // Ambil hasil ARAS dari session (jika ada)

    return view('user.dashboard', compact(
        'alternativesCount',
        'criteriaCount',
        'subcriteriaCount',
        'topAlternatives',
        'result' // penting!
    ));
}

public function statusLaporan()
{
    $userId = Auth::id();

    // Ambil laporan terbaru milik user
    $report = Report::where('user_id', $userId)->latest()->first();

    if (!$report) {
        return redirect()->back()->with('warning', 'Belum ada laporan yang dikirim.');
    }

    // Pastikan data terbaru diambil dari database
    $report->refresh();

    return view('user.laporan_status', compact('report'));
}


}
