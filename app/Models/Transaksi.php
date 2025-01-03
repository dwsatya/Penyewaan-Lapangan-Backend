<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'transaksi';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_user',
        'id_lapangan',
        'id_pelatih',
        'total_harga',
    ];
    public function user()
    {
        return $this->hasMany(User::class);    
    }
    public function pelatih()
    {
        return $this->hasMany(Pelatih::class);    
    }
    public function lapangan()
    {
        return $this->hasMany(DetailLapangan::class);    
    }
}
