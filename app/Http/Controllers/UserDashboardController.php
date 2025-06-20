<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alternative;
use App\Models\Criteria;

class UserDashboardController extends Controller
{
    public function index()
{
    $user = auth()->user();

    $alternatives = $user->alternatives ?? collect(); // fallback ke koleksi kosong
    $alternativesCount = $alternatives->count();
    $criteriaCount = Criteria::count();
    $topAlternatives = $alternatives->sortByDesc('Ki')->take(5);

    $result = session('result'); // Ambil hasil ARAS dari session (jika ada)

    return view('user.dashboard', compact(
        'alternativesCount',
        'criteriaCount',
        'topAlternatives',
        'result' // penting!
    ));
}

}
