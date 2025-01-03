<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelatih;
use Illuminate\Support\Facades\Validator;

class PelatihController extends Controller
{
    // Menampilkan semua data pelatih
    public function index()
    {
        $pelatih = Pelatih::all();

        return response()->json([
            'success' => true,
            'message' => 'Daftar Semua Pelatih',
            'data' => $pelatih,
        ], 200);
    }

    // Menyimpan data pelatih baru
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_pelatih' => 'required|string|max:255',
            'no_telepon' => 'nullable|string|max:15',
            'tarif_per_jam' => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi Gagal',
                'errors' => $validator->errors(),
            ], 400);
        }

        $pelatih = Pelatih::create([
            'nama_pelatih' => $request->nama_pelatih,
            'no_telepon' => $request->no_telepon,
            'tarif_per_jam' => $request->tarif_per_jam,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data Pelatih Berhasil Ditambahkan',
            'data' => $pelatih,
        ], 201);
    }

    // Menampilkan detail pelatih berdasarkan ID
    public function show($id)
    {
        $pelatih = Pelatih::find($id);

        if (!$pelatih) {
            return response()->json([
                'success' => false,
                'message' => 'Data Pelatih Tidak Ditemukan',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail Pelatih',
            'data' => $pelatih,
        ], 200);
    }

    // Mengupdate data pelatih
    public function update(Request $request, $id)
    {
        $pelatih = Pelatih::find($id);

        if (!$pelatih) {
            return response()->json([
                'success' => false,
                'message' => 'Data Pelatih Tidak Ditemukan',
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'nama_pelatih' => 'sometimes|required|string|max:255',
            'no_telepon' => 'sometimes|required|string|max:15',
            'tarif_per_jam' => 'sometimes|required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi Gagal',
                'errors' => $validator->errors(),
            ], 400);
        }

        $pelatih->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Data Pelatih Berhasil Diupdate',
            'data' => $pelatih,
        ], 200);
    }

    // Menghapus data pelatih
    public function destroy($id)
    {
        $pelatih = Pelatih::find($id);

        if (!$pelatih) {
            return response()->json([
                'success' => false,
                'message' => 'Data Pelatih Tidak Ditemukan',
            ], 404);
        }

        $pelatih->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data Pelatih Berhasil Dihapus',
        ], 200);
    }
}
