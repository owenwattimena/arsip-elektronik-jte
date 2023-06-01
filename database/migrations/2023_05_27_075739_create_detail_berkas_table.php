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
        Schema::create('detail_berkas', function (Blueprint $table) {
            $table->unsignedBigInteger('berkas_id');
            $table->string('berkas');

            $table->foreign('berkas_id')->references('id')->on('berkas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_berkas');
    }
};
