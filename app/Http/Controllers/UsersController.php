<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;  // Tambahkan ini untuk mengimpor Hash facade

class UsersController extends Controller
{
    // Menampilkan semua data pengguna
    public function index()
    {
        $users = User::all();

        return response()->json([
            'success' => true,
            'message' => 'Daftar Semua Pengguna',
            'data' => $users,
        ], 200);
    }

    // Menyimpan data pengguna baru
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'no_telepon' => 'required|string|max:15',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi Gagal',
                'errors' => $validator->errors(),
            ], 400);
        }

        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),  // Ganti bcrypt menjadi Hash::make
            'no_telepon' => $request->no_telepon,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data Pengguna Berhasil Ditambahkan',
            'data' => $user,
        ], 201);
    }

    // Menampilkan detail pengguna berdasarkan ID
    public function show($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Data Pengguna Tidak Ditemukan',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail Pengguna',
            'data' => $user,
        ], 200);
    }

    // Mengupdate data pengguna
    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Data Pengguna Tidak Ditemukan',
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'username' => 'sometimes|required|string|max:255|unique:users',
            'email' => 'sometimes|required|email|max:255|unique:users',
            'password' => 'sometimes|required|string|min:8',
            'no_telepon' => 'sometimes|required|string|max:15',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi Gagal',
                'errors' => $validator->errors(),
            ], 400);
        }

        if ($request->has('password')) {
            $request->merge(['password' => Hash::make($request->password)]);  // Ganti bcrypt menjadi Hash::make
        }

        $user->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Data Pengguna Berhasil Diupdate',
            'data' => $user,
        ], 200);
    }

    // Menghapus data pengguna
    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Data Pengguna Tidak Ditemukan',
            ], 404);
        }

        $user->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data Pengguna Berhasil Dihapus',
        ], 200);
    }
}
