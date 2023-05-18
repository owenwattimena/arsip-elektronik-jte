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
        Schema::create('dosen_plp_prodi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dosen_plp_id');
            $table->unsignedBigInteger('prodi_id');

            $table->foreign('dosen_plp_id')->references('id')->on('dosen_plp');
            $table->foreign('prodi_id')->references('id')->on('program_studi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dosen_plp_prodi');
    }
};
