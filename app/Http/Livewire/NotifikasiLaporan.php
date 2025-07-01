<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Laporan;
use Livewire\WithPolling;

class NotifikasiLaporan extends Component
{

    
    public function render()
    {
        $jumlahLaporanBaru = Laporan::where('status', 'belum_dibaca')->count();
        return view('livewire.notifikasi-laporan', compact('jumlahLaporanBaru'));
    }
}
