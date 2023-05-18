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
        Schema::table('dosen_plp', function(Blueprint $table){
            $table->enum('jenis_kelamin', ['l', 'p'])->nullable()->change();
            $table->string('tempat_lahir')->nullable()->change();
            $table->date('tanggal_lahir')->nullable()->change();
            $table->string('agama')->nullable()->change();
            $table->mediumText('alamat')->nullable()->change();
            $table->string('telepon')->nullable()->change();
            $table->string('email')->nullable()->change();
            $table->string('foto')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dosen_plp', function(Blueprint $table){
            $table->enum('jenis_kelamin', ['l', 'p'])->change();
            $table->string('tempat_lahir')->change();
            $table->date('tanggal_lahir')->change();
            $table->string('agama')->change();
            $table->mediumText('alamat')->change();
            $table->string('telepon')->change();
            $table->string('email')->change();
            $table->string('foto')->change();
        });
    }
};
