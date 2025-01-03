<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelatih extends Model
{
    use HasFactory;
    protected $table = 'pelatih';
    /**
     * Kolom yang dapat diisi (fillable).
     */
    protected $fillable = [
        'nama_pelatih',
        'no_telepon',
        'tarif_per_jam',
    ];

    /**
     * Menyembunyikan kolom-kolom tertentu ketika model di-serialize (misalnya untuk JSON).
     */
    protected $hidden = [
        // Kolom yang ingin disembunyikan jika diperlukan
    ];

    /**
     * Validasi aturan untuk model Pelatih.
     */
    public static function rules()
    {
        return [
            'nama_pelatih' => 'required|string|max:255',
            'no_telepon' => 'nullable|string|max:15',
            'tarif_per_jam' => 'required|numeric|min:0',
        ];
    }
    public function pelatih()
    {
        return $this->belongsTo(Transaksi::class);
    }
}
