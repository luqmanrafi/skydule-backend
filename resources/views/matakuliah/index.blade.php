@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Daftar Matakuliah</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <a href="{{ route('matakuliah.create') }}" class="btn btn-primary mb-3">Tambah Matakuliah</a>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nama Matakuliah</th>
                <th>Dosen</th>
                <th>Jenis</th>
                <th>Hari</th>
                <th>Jam</th>
                <th>Ruangan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($matakuliah as $m)
                <tr>
                    <td>{{ $m->id_matakuliah }}</td>
                    <td>{{ $m->nama_matakuliah }}</td>
                    <td>{{ $m->dosen_pengajar }}</td>
                    <td>{{ $m->jenis_matakuliah }}</td>
                    <td>{{ $m->hari }}</td>
                    <td>{{ $m->jam_mulai }} - {{ $m->jam_selesai }}</td>
                    <td>{{ $m->ruangan }}</td>
                    <td>
                        <a href="{{ route('matakuliah.edit', $m->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('matakuliah.destroy', $m->id) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Yakin ingin menghapus?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
