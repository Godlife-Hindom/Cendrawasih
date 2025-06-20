<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    // Admin: Kirim laporan
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        Report::create([
            'user_id' => Auth::id(), // asumsi admin login
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return redirect()->back()->with('success', 'Laporan berhasil dikirim');
    }

    // Pimpinan: Melihat semua laporan
    public function index()
    {
        $reports = Report::with('user')->latest()->get();
        return view('reports.index', compact('reports'));
    }

    // Pimpinan: Tampilkan 1 laporan
    public function show($id)
    {
        $report = Report::findOrFail($id);
        return view('reports.show', compact('report'));
    }

    // Pimpinan: Evaluasi dan persetujuan
    public function evaluate(Request $request, $id)
    {
        $request->validate([
            'evaluation' => 'required',
            'status' => 'required|in:approved,rejected',
        ]);

        $report = Report::findOrFail($id);
        $report->evaluation = $request->evaluation;
        $report->status = $request->status;
        $report->save();

        return redirect()->route('reports.index')->with('success', 'Evaluasi dan persetujuan berhasil disimpan');
    }
}
