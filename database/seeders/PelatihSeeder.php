<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pelatih;

class PelatihSeeder extends Seeder
{
    public function run()
    {
        // Data untuk diinsert ke tabel pelatih
        Pelatih::insert([
            [
                'nama_pelatih' => 'Andi Wijaya',
                'no_telepon' => '081234567890',
                'tarif_per_jam' => 200000.00,
            ],
            [
                'nama_pelatih' => 'Siti Aisyah',
                'no_telepon' => '081987654321',
                'tarif_per_jam' => 250000.00,
            ],
            [
                'nama_pelatih' => 'Budi Santoso',
                'no_telepon' => '081223344556',
                'tarif_per_jam' => 300000.00,
            ],
        ]);
    }
}
