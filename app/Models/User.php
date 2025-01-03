<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class User extends Model
{
    use HasFactory;

    /**
     * Kolom yang dapat diisi (fillable).
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'no_telepon',
    ];

    /**
     * Menyembunyikan kolom-kolom tertentu ketika model di-serialize (misalnya untuk JSON).
     */
    protected $hidden = [
        'password',
    ];

    /**
     * Mutator untuk mengenkripsi password secara otomatis sebelum disimpan.
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    /**
     * Validasi aturan untuk model User.
     */
    public static function rules()
    {
        return [
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'no_telepon' => 'nullable|string|max:15',
        ];
    }
    public function user()
    {
        return $this->belongsTo(Transaksi::class);
    }
}
