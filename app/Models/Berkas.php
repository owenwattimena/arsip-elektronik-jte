<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
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

    /**
     * Get the dosenPlpProdi that owns the Berkas
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function dosenPlpProdi(): BelongsTo
    {
        return $this->belongsTo(DosenPlpProdi::class, 'dosen_plp_prodi_id', 'id');
    }

    /**
     * Get the tahunAkademik that owns the Berkas
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tahunAkademik(): BelongsTo
    {
        return $this->belongsTo(TahunAkademik::class, 'tahun_akademik_id', 'id');
    }

    /**
     * Get all of the detail for the Berkas
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function detail(): HasMany
    {
        return $this->hasMany(DetailBerkas::class, 'berkas_id', 'id');
    }
}
