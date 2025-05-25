@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Edit Matakuliah</h2>

    <form action="{{ route('matakuliah.update', $matakuliah->id) }}" method="POST" class="mt-4">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nama Matakuliah</label>
            <input type="text" name="nama_matakuliah" class="form-control" value="{{ $matakuliah->nama_matakuliah }}">
        </div>

        <div class="mb-3">
            <label>Dosen Pengajar</label>
            <input type="text" name="dosen_pengajar" class="form-control" value="{{ $matakuliah->dosen_pengajar }}">
        </div>

        <div class="mb-3">
            <label>Jenis Matakuliah</label>
            <input type="text" name="jenis_matakuliah" class="form-control" value="{{ $matakuliah->jenis_matakuliah }}">
        </div>

        <div class="mb-3">
            <label>Hari</label>
            <input type="text" name="hari" class="form-control" value="{{ $matakuliah->hari }}">
        </div>

        <div class="mb-3">
            <label>Jam Mulai</label>
            <input type="time" name="jam_mulai" class="form-control" value="{{ $matakuliah->jam_mulai }}">
        </div>

        <div class="mb-3">
            <label>Jam Selesai</label>
            <input type="time" name="jam_selesai" class="form-control" value="{{ $matakuliah->jam_selesai }}">
        </div>

        <div class="mb-3">
            <label>Ruangan</label>
            <input type="text" name="ruangan" class="form-control" value="{{ $matakuliah->ruangan }}">
        </div>

        <button type="submit" class="btn btn-success">Simpan Perubahan</button>
        <a href="{{ route('matakuliah.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
