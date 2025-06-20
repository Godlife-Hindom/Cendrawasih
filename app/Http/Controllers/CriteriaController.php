<?php

namespace App\Http\Controllers;

use App\Models\Criteria;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CriteriaController extends Controller
{
    public function index(): View
    {
        $criteria = Criteria::all();
        return view('criteria.index', compact('criteria'));
    }

    public function create(): View
    {
        return view('criteria.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'weight' => 'required|numeric|min:0',
            'code' => 'required|string|unique:criteria,code',
            'type' => 'required|in:benefit,cost',
        ]);

        Criteria::create($request->all());
        return redirect()->route('criteria.index')->with('success', 'Kriteria berhasil ditambahkan!');
    }

    public function edit(Criteria $criterion): View
    {
        return view('criteria.edit', ['criterion' => $criterion]);
    }

    public function update(Request $request, Criteria $criterion)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'weight' => 'required|numeric|min:0',
        ]);

        $criterion->update($request->all());
        return redirect()->route('criteria.index')->with('success', 'Kriteria berhasil diperbarui!');
    }

    public function destroy(Criteria $criterion)
    {
        $criterion->delete();
        return redirect()->route('criteria.index')->with('success', 'Kriteria dihapus.');
    }
}
