@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Dashboard Kuliah</h2>

    <div class="row">
        {{-- Jadwal Mata Kuliah --}}
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    Jadwal Mata Kuliah
                </div>
                <div class="card-body">
                    @if ($matakuliah->isEmpty())
                        <p class="text-muted">Belum ada jadwal mata kuliah.</p>
                    @else
                        <ul class="list-group">
                            @foreach ($matakuliah as $mk)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <strong>{{ $mk->nama_matakuliah }}</strong><br>
                                        <small>{{ $mk->hari }} : {{ $mk->jam_mulai }} - {{ $mk->jam_selesai }}</small>
                                    </div>
                                    <span class="badge bg-secondary">{{ $mk->ruangan }}</span>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>

        {{-- Tugas --}}
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header bg-success text-white">
                    Daftar Tugas
                </div>
                <div class="card-body">
                    @if ($tugas->isEmpty())
                        <p class="text-muted">Belum ada tugas.</p>
                    @else
                        <ul class="list-group">
                            @foreach ($tugas as $item)
                                <li class="list-group-item">
                                    <strong>{{ $item->judul_tugas }}</strong><br>
                                    <small class="text-muted">{{ $item->nama_matakuliah }}</small><br>
                                    <span class="badge bg-warning text-dark mt-1">Deadline: {{ $item->deadline_tugas }}</span>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
