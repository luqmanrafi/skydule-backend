@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Tambah Tugas Baru</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('tugas.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="nama_matakuliah" class="form-label">Nama Mata Kuliah</label>
            <input type="text" class="form-control" name="nama_matakuliah" id="nama_matakuliah" required>
        </div>

        <div class="mb-3">
            <label for="judul_tugas" class="form-label">Judul Tugas</label>
            <input type="text" class="form-control" name="judul_tugas" id="judul_tugas" required>
        </div>

        <div class="mb-3">
            <label for="deadline_tugas" class="form-label">Deadline</label>
            <input type="date" class="form-control" name="deadline_tugas" id="deadline_tugas" required>
        </div>

        <div class="mb-3">
            <label for="deskripsi_tugas" class="form-label">Deskripsi</label>
            <textarea class="form-control" name="deskripsi_tugas" id="deskripsi_tugas" rows="3"></textarea>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('tugas.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
