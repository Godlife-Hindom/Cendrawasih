<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subcriteria;
use App\Models\Criteria;

class SubcriteriaController extends Controller
{
    public function index($criteria_id)
{
    $criteria = Criteria::findOrFail($criteria_id); // cari kriteria
    $subcriterias = Subcriteria::where('criteria_id', $criteria_id)->get(); // ambil subkriterianya

    return view('subcriteria.index', compact('criteria', 'subcriterias'));
}

    public function create(Criteria $criteria)
    {
        return view('subcriteria.create', ['criteria' => $criteria]);
    }

    public function store(Request $request, Criteria $criteria)
    {
        $request->validate([
            'name' => 'required',
            'range' => 'required',
            'score' => 'required|integer',
        ]);

        $criteria->subcriterias()->create($request->only(['name', 'range', 'score']));

        return redirect()->route('subcriterias.index', $criteria->id)->with('success', 'Subkriteria ditambahkan');
    }

        public function edit(Criteria $criteria, Subcriteria $subcriteria)
    {
        return view('subcriteria.edit', compact('criteria', 'subcriteria'));
    }

    public function update(Request $request, Criteria $criteria, Subcriteria $subcriteria)
    {
        $request->validate([
            'name' => 'required',
            'range' => 'required',
            'score' => 'required|integer',
        ]);

        $subcriteria->update($request->only(['name', 'range', 'score']));

        return redirect()->route('subcriterias.index', $criteria->id)->with('success', 'Subkriteria berhasil diperbarui.');
    }

    public function destroy(Criteria $criteria, Subcriteria $subcriteria)
    {
        $subcriteria->delete();

        return redirect()->route('subcriterias.index', $criteria->id)->with('success', 'Subkriteria berhasil dihapus.');
    }

}
