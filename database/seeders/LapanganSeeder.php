<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DetailLapangan;

class LapanganSeeder extends Seeder
{
    public function run()
    {
        // Data untuk diinsert ke tabel detail_lapangan
        DetailLapangan::insert([
            [
                'nama_lapangan' => 'Lapangan A',
                'lokasi_lapangan' => 'Jl. Merdeka No. 1',
                'tarif_per_jam' => 100000.00,
            ],
            [
                'nama_lapangan' => 'Lapangan B',
                'lokasi_lapangan' => 'Jl. Sudirman No. 45',
                'tarif_per_jam' => 120000.00,
            ],
            [
                'nama_lapangan' => 'Lapangan C',
                'lokasi_lapangan' => 'Jl. Thamrin No. 99',
                'tarif_per_jam' => 150000.00,
            ],
        ]);
    }
}
