<?php

namespace App\Http\Controllers;

use App\Models\Matakuliah;
use Illuminate\Http\Request;

class MatakuliahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $matakuliah = Matakuliah::all();
        return response()->json([
            'message' => 'Jadwal retrieved successfully',
            'data' => $matakuliah,
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'matakuliah' => 'required|array',
            'matakuliah.*.id_matakuliah' => 'required',
            'matakuliah.*.nama_matakuliah' => 'required|string',
            'matakuliah.*.dosen_pengajar' => 'required|string',
            'matakuliah.*.jenis_matakuliah' => 'required',
            'matakuliah.*.hari' => 'required',
            'matakuliah.*.jam_mulai' => 'required',
            'matakuliah.*.jam_selesai' => 'required',
            'matakuliah.*.ruangan' => 'required',
        ]);
        $datas = $request->matakuliah;
        if (isset($datas[0])){
         foreach($request->matakuliah as $data) {
            Matakuliah::create([
                'id_matakuliah' => $data['id_matakuliah'],
                'nama_matakuliah' => $data['nama_matakuliah'],
                'dosen_pengajar' => $data['dosen_pengajar'],
                'jenis_matakuliah' => $data['jenis_matakuliah'],
                'hari' => $data['hari'],
                'jam_mulai' => $data['jam_mulai'],
                'jam_selesai' => $data['jam_selesai'],
                'ruangan' => $data['ruangan'],
            ]);
        }
    } else {
        Matakuliah::create([
                'id_matakuliah' => $request->id_matakuliah,
                'nama_matakuliah' => $request->nama_matakuliah,
                'dosen_pengajar' => $request->dosen_pengajar,
                'jenis_matakuliah' => $request->jenis_matakuliah,
                'hari' => $request->hari,
                'jam_mulai' => $request->jam_mulai,
                'jam_selesai' => $request->jam_selesai,
                'ruangan' => $request->ruangan,
        ]);
    }
        
        return response()->json([
            'message' => 'Jadwal created successfully',
            'data' => $data
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id_matakuliah)
    {
        $matakuliah = Matakuliah::where('id_matakuliah', $id_matakuliah);
        if (!$matakuliah) {
            return response()->json([
                'message' => 'Jadwal not found',
            ], 404);
        }
        return response()->json([
            'message' => 'Jadwal retrieved successfully',
            'data' => $matakuliah,
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(String $id)
    {
        $matakuliah = Matakuliah::find($id);
        if (!$matakuliah) {
            return response()->json([
                'message' => 'Jadwal not found',
            ], 404);
        }
        $matakuliah->edit();
        return response()->json([
            'message' => 'Jadwal retrieved successfully',
            'data' => $matakuliah,
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, String $id)
    {
        $matakuliah = Matakuliah::find($id);
        if (!$matakuliah) {
            return response()->json([
                'message' => 'Jadwal not found',
            ], 404);
        }
        $request->validate([
            'nama_matakuliah' => 'required|string',
            'dosen_pengajar' => 'required|string',
            'jenis_matakuliah' => 'required',
            'hari' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
            'ruangan' => 'required',
        ]);
        $matakuliah->update([
            'nama_matakuliah' => $request->nama_matakuliah,
            'dosen_pengajar' => $request->dosen_pengajar,
            'jenis_matakuliah' => $request->jenis_matakuliah,
            'hari' => $request->hari,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'ruangan' => $request->ruangan,
        ]);
        return response()->json([
            'message' => 'Jadwal berhasil diperbarui',
            'data' => $matakuliah,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id)
    {
        $matakuliah = Matakuliah::find($id);
        if (!$matakuliah) {
            return response()->json([
                'message' => 'Jadwal not found',
            ], 404);
        }
        $matakuliah->delete();
        return response()->json([
            'message' => 'Jadwal berhasil dihapus',
        ], 200);
    }
}
