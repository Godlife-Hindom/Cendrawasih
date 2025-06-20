<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Laporan;
use Illuminate\Support\Carbon;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        // Ambil semua user dengan role user
        $allUsers = User::where('role', 'user')->get();

        // Jika user dipilih, ambil laporannya
        $selectedUser = null;
        $userLaporan = collect();

        if ($request->has('user')) {
            $selectedUser = User::find($request->get('user'));
            $userLaporan = Laporan::with('user')
                ->where('user_id', $selectedUser->id)
                ->orderBy('peringkat')
                ->get();
        }

        return view('admin.laporan.index', compact('allUsers', 'selectedUser', 'userLaporan'));
    }

    public function store(Request $request)
    {
        $data = $request->all();

        foreach ($data['name'] as $i => $nama) {
            Laporan::create([
                'user_id' => auth()->id(),
                'name' => $nama,
                'score' => $data['score'][$i],
                'peringkat' => $data['peringkat'][$i],
            ]);
        }

        return redirect()->route('user.dashboard')->with('success', 'Laporan berhasil dikirim ke admin.');
    }

    public function showByUser($id)
    {
        $user = User::findOrFail($id);
        $laporan = Laporan::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.laporan.show', compact('user', 'laporan'));
    }

    public function destroy($id)
    {
        $laporan = Laporan::findOrFail($id);
        $userId = $laporan->user_id; // ambil user_id dari laporan yang dihapus
        $laporan->delete();

        // redirect ke halaman laporan berdasarkan user yang bersangkutan
        return redirect()->route('admin.laporan.semua', ['id' => $userId])
                        ->with('success', 'Laporan berhasil dihapus.');
    }

}
