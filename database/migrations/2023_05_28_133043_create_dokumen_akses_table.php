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
        Schema::create('dokumen_akses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dokumen_id');
            $table->unsignedBigInteger('dosen_plp_id');

            $table->foreign('dokumen_id')->references('id')->on('dokumen')->onDelete('cascade');
            $table->foreign('dosen_plp_id')->references('id')->on('dosen_plp')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dokumen_akses');
    }
};
