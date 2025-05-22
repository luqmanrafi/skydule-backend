<?php

namespace App\Http\Controllers;

use App\Models\Tugas;
use Illuminate\Http\Request;

class TugasController extends Controller
{
    public function index()
    {
        $tugas = Tugas::all();
        return response()->json([
            'message' => 'Tugas berhasil ditampilkan',
            'data' => $tugas,
        ], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'tugas' => 'nullable|array',
            'tugas.*.nama_matakuliah' => 'required|string',
            'tugas.*.judul_tugas' => 'required|string',
            'tugas.*.deadline_tugas' => 'required|date',
            'tugas.*.deskripsi_tugas' => 'nullable|string',

            'nama_matakuliah' => 'sometimes|required|string',
            'judul_tugas' => 'sometimes|required|string',
            'deadline_tugas' => 'sometimes|required|date',
            'deskripsi_tugas' => 'sometimes|nullable|string',
        ]);

        $data = [];
    try {
        if ($request->has('tugas') && is_array($request->tugas)) {
            foreach ($request->tugas as $item) {
                $data[] = Tugas::create($item);
            }
        } else {
            $data = Tugas::create([
                'nama_matakuliah' => $request->nama_matakuliah,
                'judul_tugas' => $request->judul_tugas,
                'deadline_tugas' => $request->deadline_tugas,
                'deskripsi_tugas' => $request->deskripsi_tugas,
            ]);
        }
        return response()->json([
            'message' => 'Tugas berhasil dibuat',
            'data' => $data,
        ], 201);
        } catch (\Exception $e) {
        return response()->json([
            'message' => 'Gagal membuat tugas',
            'error' => $e->getMessage(),
        ], 500);
        }
    }

    public function show($id)
    {
        $tugas = Tugas::find($id);
        if (!$tugas) {
            return response()->json(['message' => 'Tugas tidak ditemukan'], 404);
        }
        return response()->json([
            'message' => 'Tugas berhasil ditampilkan',
            'data' => $tugas,
        ]);
    }

    public function update(Request $request, $id)
    {
        $tugas = Tugas::find($id);
        if (!$tugas) {
            return response()->json(['message' => 'Tugas tidak ditemukan'], 404);
        }

        $request->validate([
            'nama_matakuliah' => 'required|string',
            'judul_tugas' => 'required|string',
            'deadline_tugas' => 'required|date',
            'deskripsi_tugas' => 'nullable|string',
        ]);

        $tugas->update($request->all());

        return response()->json([
            'message' => 'Sukses memperbarui tugas',
            'data' => $tugas,
        ]);
    }

    public function destroy($id)
    {
        $tugas = Tugas::find($id);
        if (!$tugas) {
            return response()->json(['message' => 'Tugas tidak ditemukan'], 404);
        }

        $tugas->delete();

        return response()->json(['message' => 'Tugas berhasil dihapus']);
    }
}
