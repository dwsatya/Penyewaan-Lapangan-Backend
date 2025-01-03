<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailLapangan extends Model
{
    use HasFactory;

    // Nama tabel jika berbeda dengan nama model
    protected $table = 'detail_lapangan';

    // Field yang dapat diisi secara mass-assignment
    protected $fillable = [
        'nama_lapangan',
        'lokasi_lapangan',
        'tarif_per_jam',
    ];
    public function lapangan()
    {
        return $this->belongsTo(Transaksi::class);
    }
}
