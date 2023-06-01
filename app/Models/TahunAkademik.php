<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TahunAkademik extends Model
{
    use HasFactory;
    protected $table = 'tahun_akademik';

    protected $fillable = [
        'tahun_akademik'
    ];

    /**
     * Get all of the berkas for the TahunAkademik
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function berkas(): HasMany
    {
        return $this->hasMany(Berkas::class, 'tahun_akademik_id', 'id');
    }
}
