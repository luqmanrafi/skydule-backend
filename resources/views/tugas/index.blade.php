@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Daftar Tugas</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('tugas.create') }}" class="btn btn-primary mb-3">Tambah Tugas</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Mata Kuliah</th>
                <th>Judul</th>
                <th>Deadline</th>
                <th>Deskripsi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tugas as $item)
                <tr>
                    <td>{{ $item->nama_matakuliah }}</td>
                    <td>{{ $item->judul_tugas }}</td>
                    <td>{{ $item->deadline_tugas }}</td>
                    <td>{{ $item->deskripsi_tugas }}</td>
                    <td>
                        <a href="{{ route('tugas.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('tugas.destroy', $item->id) }}" method="POST" style="display:inline-block;">
                            @csrf @method('DELETE')
                            <button onclick="return confirm('Yakin hapus?')" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
