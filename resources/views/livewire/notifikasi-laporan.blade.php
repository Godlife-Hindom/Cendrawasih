<div wire:poll.10000ms>
    <a href="{{ route('admin.laporan.index') }}" class="position-relative {{ request()->routeIs('admin.laporan.index') ? 'active' : '' }}">
        <i class="bi bi-bell" style="font-size: 1.5rem;"></i>
        @if($jumlahLaporanBaru > 0)
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                {{ $jumlahLaporanBaru }}
                <span class="visually-hidden">Laporan</span>
            </span>
        @endif
        <span>Pemberitahuan Laporan</span>
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
