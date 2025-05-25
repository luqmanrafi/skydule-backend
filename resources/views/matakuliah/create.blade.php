@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Tambah Matakuliah</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <strong>Ups! Ada yang salah:</strong>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('matakuliah.store') }}" method="POST" class="mt-4">
        @csrf

        <div class="mb-3">
            <label>ID Matakuliah</label>
            <input type="text" name="id_matakuliah" class="form-control" value="{{ old('id_matakuliah') }}">
        </div>

        <div class="mb-3">
            <label>Nama Matakuliah</label>
            <input type="text" name="nama_matakuliah" class="form-control" value="{{ old('nama_matakuliah') }}">
        </div>

        <div class="mb-3">
            <label>Dosen Pengajar</label>
            <input type="text" name="dosen_pengajar" class="form-control" value="{{ old('dosen_pengajar') }}">
        </div>

        <div class="mb-3">
            <label>Jenis Matakuliah</label>
            <input type="text" name="jenis_matakuliah" class="form-control" value="{{ old('jenis_matakuliah') }}">
        </div>

        <div class="mb-3">
            <label>Hari</label>
            <input type="text" name="hari" class="form-control" value="{{ old('hari') }}">
        </div>

        <div class="mb-3">
            <label>Jam Mulai</label>
            <input type="time" name="jam_mulai" class="form-control" value="{{ old('jam_mulai') }}">
        </div>

        <div class="mb-3">
            <label>Jam Selesai</label>
            <input type="time" name="jam_selesai" class="form-control" value="{{ old('jam_selesai') }}">
        </div>

        <div class="mb-3">
            <label>Ruangan</label>
            <input type="text" name="ruangan" class="form-control" value="{{ old('ruangan') }}">
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('matakuliah.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
