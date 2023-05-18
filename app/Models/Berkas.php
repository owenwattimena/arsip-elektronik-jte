<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Berkas extends Model
{
    use HasFactory;
    protected $table = 'berkas';
    protected $fillable = [
        'dosen_plp_prodi_id',
        'tahun_akademik_id',
        'jenis_berkas',
        'berkas',
        'semester',
    ];

    /**
     * Get the user associated with the Berkas
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function penilaian(): HasOne
    {
        return $this->hasOne(Penilaian::class, 'berkas_id', 'id');
    }
}
