<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    /**
     * Halaman index untuk melihat seluruh feedback (hanya admin & pimpinan).
     */
    public function index()
    {
        if (!in_array(Auth::user()->role, ['admin', 'pimpinan'])) {
            abort(403, 'Anda tidak memiliki akses untuk melihat feedback.');
        }

        $feedbacks = Feedback::with('user')->latest()->get();

        return view('pimpinan.feedback', compact('feedbacks'));
    }

    /**
     * Form untuk mengisi feedback (boleh semua role).
     */
    public function form()
    {
        $hasFilled = Feedback::where('user_id', Auth::id())->exists();

        if ($hasFilled) {
            return redirect()->back()->with('warning', 'Anda sudah mengisi feedback.');
        }

        $role = Auth::user()->role;

        // Tampilkan view sesuai role
        return match ($role) {
            'admin' => view('admin.feedback.form'),
            'pimpinan' => view('pimpinan.feedback.form'),
            default => view('user.feedback.form'), // fallback untuk role "user"
        };
    }

    /**
     * Simpan feedback ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'sus' => 'required|array',
            'sus.*' => 'required|integer|min:1|max:5',
        ]);

        Feedback::create([
            'user_id' => Auth::id(),
            'responses' => json_encode($request->sus),
        ]);

        // Redirect ke dashboard sesuai role
        $role = Auth::user()->role;

        return match ($role) {
            'admin' => redirect()->route('admin.dashboard')->with('success', 'Terima kasih atas feedback Anda!'),
            'pimpinan' => redirect()->route('pimpinan.dashboard')->with('success', 'Terima kasih atas feedback Anda!'),
            default => redirect()->route('user.dashboard')->with('success', 'Terima kasih atas feedback Anda!'),
        };
    }
}
