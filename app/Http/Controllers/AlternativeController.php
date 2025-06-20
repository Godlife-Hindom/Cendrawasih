<?php

namespace App\Http\Controllers;

use App\Models\Alternative;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;

class AlternativeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


     public function index(Request $request): View
{
    $query = Alternative::with('user');

    // Filter berdasarkan user_id (kalau dipilih)
    if ($request->filled('user_id')) {
        $query->where('user_id', $request->user_id);
    }

    // Filter berdasarkan nama lokasi (search)
    if ($request->filled('search')) {
        $query->where('name', 'like', '%' . $request->search . '%');
    }

    // Ambil hasil dengan pagination
    $alternatives = $query->paginate(10)->withQueryString();

    // Ambil semua user untuk dropdown
    $users = \App\Models\User::all();

    return view('alternatives.index', compact('alternatives', 'users'));
}


}
