<?php

namespace App\Http\Controllers;

use App\Models\Matakuliah;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isArray;

class MatakuliahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $matakuliah = Matakuliah::all();
        if ($request->wantsJson()) {
        return response()->json([
            'message' => 'Jadwal retrieved successfully',
            'data' => $matakuliah,
        ], 200);
    }
     return view('matakuliah.index', compact('matakuliah'));
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
        'matakuliah' => 'nullable|array',
        'matakuliah.*.id_matakuliah' => 'required',
        'matakuliah.*.nama_matakuliah' => 'required|string',
        'matakuliah.*.dosen_pengajar' => 'required|string',
        'matakuliah.*.jenis_matakuliah' => 'required|string',
        'matakuliah.*.hari' => 'required|string',
        'matakuliah.*.jam_mulai' => 'required',
        'matakuliah.*.jam_selesai' => 'required',
        'matakuliah.*.ruangan' => 'required|string',

        'id_matakuliah' => 'sometimes|required',
        'nama_matakuliah' => 'sometimes|required|string',
        'dosen_pengajar' => 'sometimes|required|string',
        'jenis_matakuliah' => 'sometimes|required|string',
        'hari' => 'sometimes|required|string',
        'jam_mulai' => 'sometimes|required',
        'jam_selesai' => 'sometimes|required',
        'ruangan' => 'sometimes|required|string',
    ]);

    $data = [];
    try {
        if ($request->has('matakuliah') && is_array($request->matakuliah)) {
            foreach ($request->matakuliah as $item) {
                // Cek jam_mulai pada hari & ruangan yang sama
                $exists = Matakuliah::where('hari', $item['hari'])
                    ->where('ruangan', $item['ruangan'])
                    ->where('jam_mulai', $item['jam_mulai'])
                    ->exists();
                if ($exists) {
                    return response()->json([
                        'message' => 'Jam mulai sudah terpakai pada hari dan ruangan yang sama: ' . $item['jam_mulai'],
                    ], 422);
                }
                $data[] = Matakuliah::create($item);
            }
        } else {
            // Cek jam_mulai pada hari & ruangan yang sama
            $exists = Matakuliah::where('hari', $request->hari)
                ->where('ruangan', $request->ruangan)
                ->where('jam_mulai', $request->jam_mulai)
                ->exists();
            if ($exists) {
                return response()->json([
                    'message' => 'Jam mulai sudah terpakai pada hari dan ruangan yang sama: ' . $request->jam_mulai,
                ], 422);
            }
            $data = Matakuliah::create([
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
            'message' => 'Matakuliah berhasil dibuat',
            'data' => $data,
        ], 201);
    } catch (\Exception $e) {
        return response()->json([
            'message' => 'Gagal membuat matakuliah',
            'error' => $e->getMessage(),
        ], 500);
    }
}

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $matakuliah = Matakuliah::find($id);
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
    public function edit(Request $request, String $id)
    {
        $matakuliah = Matakuliah::find($id);
        if (!$matakuliah) {
        if ($request->wantsJson()) {
            return response()->json([
                'message' => 'Matakuliah not found',
            ], 404);
        }
        abort(404);
    }

    if ($request->wantsJson()) {
        return response()->json([
            'message' => 'Matakuliah retrieved successfully',
            'data' => $matakuliah,
        ], 200);
    }
     return view('matakuliah.edit', compact('matakuliah'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, String $id)
    {
         $matakuliah = Matakuliah::find($id);
    if (!$matakuliah) {
        if ($request->wantsJson()) {
            return response()->json(['message' => 'Matakuliah not found'], 404);
        }
        return redirect()->route('matakuliah.index')->with('error', 'Matakuliah tidak ditemukan.');
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

    if ($request->wantsJson()) {
        return response()->json([
            'message' => 'Matakuliah berhasil diperbarui',
            'data' => $matakuliah,
        ], 200);
    }

    return redirect()->route('matakuliah.index')->with('success', 'Matakuliah berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, String $id)
{
    $matakuliah = Matakuliah::find($id);
    if (!$matakuliah) {
        if ($request->wantsJson()) {
            return response()->json(['message' => 'Matakuliah not found'], 404);
        }
        return redirect()->route('matakuliah.index')->with('error', 'Matakuliah tidak ditemukan.');
    }

    $matakuliah->delete();

    if ($request->wantsJson()) {
        return response()->json(['message' => 'Matakuliah berhasil dihapus'], 200);
    }

    return redirect()->route('matakuliah.index')->with('success', 'Matakuliah berhasil dihapus.');
}

}
