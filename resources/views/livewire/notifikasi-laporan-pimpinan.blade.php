<div wire:poll.10000ms class="nav-item">
    <a href="{{ route('pimpinan.laporan') }}"
       class="nav-link position-relative {{ request()->is('pimpinan/laporan*')}}">
        <div class="nav-icon">
            <i class="fas fa-file-alt" style="font-size: 1.2rem;"></i>

            @if($jumlahReportPending > 0)
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    {{ $jumlahReportPending }}
                    <span class="visually-hidden">Laporan Belum Ditinjau</span>
                </span>
            @endif
        </div>
        <span class="nav-text">Laporan</span>
    </a>
</div>

<style>
    .position-relative { position: relative; }
    .position-absolute { position: absolute; }
    .top-0 { top: 0; }
    .start-100 { left: 100%; }
    .translate-middle { transform: translate(-50%, -50%); }
    .badge {
        display: inline-block;
        padding: 0.35em 0.65em;
        font-size: 0.75em;
        font-weight: 700;
        color: #fff;
        text-align: center;
        border-radius: 10rem;
        background-color: red;
    }
</style>
