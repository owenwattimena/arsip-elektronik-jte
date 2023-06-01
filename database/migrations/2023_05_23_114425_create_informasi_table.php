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
        Schema::create('informasi', function (Blueprint $table) {
            $table->id();
            $table->mediumText('deskripsi');
            $table->enum('tipe', ['pemberitahuan', 'info_dosen_plp', 'info_admin']);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('dosen_plp_id')->nullable();

            $table->timestamps();

            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('dosen_plp_id')->references('id')->on('dosen_plp');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('informasi');
    }
};
