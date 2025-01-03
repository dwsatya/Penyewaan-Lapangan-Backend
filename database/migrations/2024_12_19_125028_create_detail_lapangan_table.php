<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('detail_lapangan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama_lapangan'); 
            $table->string('lokasi_lapangan', 255);
            $table->decimal('tarif_per_jam', 10); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_lapangan');
    }
};
