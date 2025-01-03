<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetailLapangan;
use Illuminate\Support\Facades\Validator;

class DetailLapanganController extends Controller
{
    // Menampilkan semua data lapangan
    public function index()
    {
        $lapangan = DetailLapangan::all();

        return response()->json([
            'success' => true,
            'message' => 'Daftar Semua Lapangan',
            'data' => $lapangan,
        ], 200);
    }

    // Menyimpan data lapangan baru
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_lapangan' => 'required|string|max:255',
            'lokasi_lapangan' => 'required|string|max:255',
            'tarif_per_jam' => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi Gagal',
                'errors' => $validator->errors(),
            ], 400);
        }

        $lapangan = DetailLapangan::create([
            'nama_lapangan' => $request->nama_lapangan,
            'lokasi_lapangan' => $request->lokasi_lapangan,
            'tarif_per_jam' => $request->tarif_per_jam,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data Lapangan Berhasil Ditambahkan',
            'data' => $lapangan,
        ], 201);
    }

    // Menampilkan detail lapangan berdasarkan ID
    public function show($id)
    {
        $lapangan = DetailLapangan::find($id);

        if (!$lapangan) {
            return response()->json([
                'success' => false,
                'message' => 'Data Lapangan Tidak Ditemukan',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail Lapangan',
            'data' => $lapangan,
        ], 200);
    }

    // Mengupdate data lapangan
    public function update(Request $request, $id)
    {
        $lapangan = DetailLapangan::find($id);

        if (!$lapangan) {
            return response()->json([
                'success' => false,
                'message' => 'Data Lapangan Tidak Ditemukan',
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'nama_lapangan' => 'sometimes|required|string|max:255',
            'lokasi_lapangan' => 'sometimes|required|string|max:255',
            'tarif_per_jam' => 'sometimes|required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi Gagal',
                'errors' => $validator->errors(),
            ], 400);
        }

        $lapangan->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Data Lapangan Berhasil Diupdate',
            'data' => $lapangan,
        ], 200);
    }

    // Menghapus data lapangan
    public function destroy($id)
    {
        $lapangan = DetailLapangan::find($id);

        if (!$lapangan) {
            return response()->json([
                'success' => false,
                'message' => 'Data Lapangan Tidak Ditemukan',
            ], 404);
        }

        $lapangan->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data Lapangan Berhasil Dihapus',
        ], 200);
    }
}
