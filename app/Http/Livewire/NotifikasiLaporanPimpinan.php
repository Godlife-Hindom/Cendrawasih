<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Report;

class NotifikasiLaporanPimpinan extends Component
{
    public function render()
    {
        $jumlahReportPending = Report::where('status', 'pending')->count();

        return view('livewire.notifikasi-laporan-pimpinan', [
            'jumlahReportPending' => $jumlahReportPending
        ]);
    }
}

