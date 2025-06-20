@extends('layouts.pimpinan')

@section('content')
<div class="container py-4">
    <h2 class="text-2xl font-bold mb-4">Top 5 Lokasi dari {{ $user->name }}</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama Lokasi</th>
                <th>Nilai</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($top5 as $alt)
                <tr>
                    <td>{{ $alt->name }}</td>
                    <td>{{ $alt->score }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection