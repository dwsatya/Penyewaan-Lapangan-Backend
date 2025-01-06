<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mengambil semua data transaksi
        $transaksi = Transaksi::with(['user', 'lapangan', 'pelatih'])->get();

        return response()->json([
            'success' => true,
            'message' => 'Daftar Semua Transaksi',
            'data' => $transaksi,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        // Validasi data
        $validator = Validator::make($request->all(), [
            'id_user' => 'required|exists:users,id',
            'id_lapangan' => 'required|exists:detail_lapangan,id',
            'id_pelatih' => 'nullable|exists:pelatih,id',
            'total_harga' => 'nullable|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors(),
            ], 422);
        }

        // Membuat transaksi baru
        $transaksi = Transaksi::create($validator->validated());

        return response()->json([
            'success' => true,
            'message' => 'Transaksi berhasil dibuat',
            'data' => $transaksi,
        ]);
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Mencari transaksi berdasarkan ID
        $transaksi = Transaksi::with(['user', 'lapangan', 'pelatih'])->find($id);

        if (!$transaksi) {
            return response()->json([
                'success' => false,
                'message' => 'Transaksi tidak ditemukan',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $transaksi,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Mencari transaksi
        $transaksi = Transaksi::find($id);

        if (!$transaksi) {
            return response()->json([
                'success' => false,
                'message' => 'Transaksi tidak ditemukan',
            ], 404);
        }

        // Validasi data
        $validated = $request->validate([
            'id_user' => 'required|exists:users,id',
            'id_lapangan' => 'required|exists:lapangan,id',
            'id_pelatih' => 'nullable|exists:pelatih,id',
            'total_harga' => 'required|numeric|min:0',
        ]);

        // Mengupdate data transaksi
        $transaksi->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Transaksi berhasil diperbarui',
            'data' => $transaksi,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Mencari transaksi
        $transaksi = Transaksi::find($id);

        if (!$transaksi) {
            return response()->json([
                'success' => false,
                'message' => 'Transaksi tidak ditemukan',
            ], 404);
        }

        // Menghapus transaksi
        $transaksi->delete();

        return response()->json([
            'success' => true,
            'message' => 'Transaksi berhasil dihapus',
        ]);
    }
}
