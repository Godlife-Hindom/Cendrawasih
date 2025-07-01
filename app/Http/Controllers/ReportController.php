<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\User;
use App\Models\Criteria;
use App\Models\Subcriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    // Admin: Kirim laporan - DIMODIFIKASI untuk UPDATE jika sudah ada
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        $userId = Auth::id();
        
        // Cek apakah user sudah memiliki laporan sebelumnya
        $existingReport = Report::where('user_id', $userId)->first();

        if ($existingReport) {
            // UPDATE laporan yang sudah ada
            $existingReport->update([
                'title' => $request->title,
                'content' => $request->content,
                'status' => 'pending', // Reset status ke pending
                'approved' => null,     // Reset approval
                'evaluation' => null,   // Reset evaluation
                'updated_at' => now(),
            ]);
            
            $message = 'Laporan berhasil diperbarui!';
        } else {
            // CREATE laporan baru jika belum ada
            Report::create([
                'user_id' => $userId,
                'title' => $request->title,
                'content' => $request->content,
                'status' => 'pending',
            ]);
            
            $message = 'Laporan berhasil dikirim!';
        }

        return redirect()->back()->with('success', $message);
    }

    // Pimpinan: Melihat semua laporan - SUDAH BENAR, hanya perlu perbaikan kecil
    public function messages()
    {
        // Ambil hanya satu laporan terbaru per user
        $reports = Report::select('reports.*')
                        ->join(\DB::raw('(SELECT user_id, MAX(created_at) as max_created_at FROM reports GROUP BY user_id) as latest'), function($join) {
                            $join->on('reports.user_id', '=', 'latest.user_id')
                                 ->on('reports.created_at', '=', 'latest.max_created_at');
                        })
                        ->with('user')
                        ->orderBy('created_at', 'desc')
                        ->get();

        return view('pimpinan.laporan', compact('reports'));
    }

    public function viewMessage($id)
    {
        $report = Report::with('alternatives')->findOrFail($id);
        $criteria = Criteria::all();
        $subcriteria = Subcriteria::with('criteria')->get();

        return view('pimpinan.pesan_detail', compact('report', 'criteria', 'subcriteria'));
    }

    // DIMODIFIKASI untuk UPDATE evaluasi tanpa menghapus laporan lain
    public function evaluate(Request $request, $id)
    {
        $request->validate([
            'evaluation' => 'required|string',
            'approval' => 'required|boolean'
        ]);

        $report = Report::findOrFail($id);
        
        // UPDATE laporan yang sedang dievaluasi saja
        $report->update([
            'evaluation' => $request->evaluation,
            'approved' => $request->approval,
            'status' => $request->approval ? 'approved' : 'rejected',
        ]);

        return redirect()->route('pimpinan.laporan')->with('success', 'Evaluasi berhasil disimpan.');
    }

    // SUDAH BENAR - Menampilkan hanya satu laporan per user
    public function laporan()
    {
        // Menggunakan Collection untuk group by user_id dan ambil yang terbaru
        $allReports = Report::with('user')->orderBy('created_at', 'desc')->get();
        
        // Group by user_id dan ambil hanya yang pertama (terbaru) dari setiap user
        $laporan = $allReports->groupBy('user_id')->map(function ($userReports) {
            return $userReports->first();
        })->values();

        return view('pimpinan.laporan', compact('laporan'));
    }

    public function showEvaluateForm($id)
    {
        $report = Report::findOrFail($id);
        return view('pimpinan.evaluasi', compact('report'));
    }

    public function deleteLaporan($id)
    {
        $report = Report::findOrFail($id);
        $userName = $report->user->name;
        
        // Hapus laporan yang dipilih saja
        $report->delete();

        return redirect()->back()->with('success', "Laporan dari {$userName} berhasil dihapus.");
    }

    // TAMBAHAN: Method untuk menghapus semua laporan dari user tertentu
    public function deleteAllUserReports($userId)
    {
        $user = User::findOrFail($userId);
        $deletedCount = Report::where('user_id', $userId)->count();
        
        Report::where('user_id', $userId)->delete();

        return redirect()->back()->with('success', "Semua laporan dari {$user->name} ({$deletedCount} laporan) berhasil dihapus.");
    }

    // TAMBAHAN: Method untuk mendapatkan statistik laporan per user
    public function getReportStats()
    {
        $stats = [
            'total_reports' => Report::count(),
            'unique_users' => Report::distinct('user_id')->count(),
            'approved_reports' => Report::where('status', 'approved')->count(),
            'rejected_reports' => Report::where('status', 'rejected')->count(),
            'pending_reports' => Report::where('status', 'pending')->count(),
        ];

        return $stats;
    }

    // TAMBAHAN: Method untuk cek status laporan user (untuk AJAX)
    public function checkUserReportStatus($userId)
    {
        $report = Report::where('user_id', $userId)->first();
        
        if ($report) {
            return response()->json([
                'has_report' => true,
                'report' => [
                    'id' => $report->id,
                    'title' => $report->title,
                    'status' => $report->status,
                    'created_at' => $report->created_at->format('d M Y H:i'),
                    'updated_at' => $report->updated_at->format('d M Y H:i'),
                ]
            ]);
        }
        
        return response()->json(['has_report' => false]);
    }
}