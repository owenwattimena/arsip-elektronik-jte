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
        Schema::create('berkas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dosen_plp_prodi_id');
            $table->unsignedBigInteger('tahun_akademik_id');
            $table->enum('jenis_berkas', ['bkd', 'lkd', 'skp']);
            $table->string('berkas');
            $table->enum('semester', ['ganjil', 'genap']);
            $table->timestamps();

            $table->foreign('dosen_plp_prodi_id')->references('id')->on('dosen_plp_prodi');
            $table->foreign('tahun_akademik_id')->references('id')->on('tahun_akademik');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('berkas');
    }
};
