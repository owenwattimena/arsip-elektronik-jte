<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Dokumen extends Model
{
    use HasFactory;
    protected $table = 'dokumen';

    protected $fillable = [
        'dokumen',
        'jenis',
        'dilihat_oleh'
    ];

    /**
     * Get the akses associated with the Dokumen
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function akses(): HasMany
    {
        // return $this->hasMany(DokumenAkses::class, 'dokumen_id', 'id');
        return $this->hasMany(DokumenAkses::class, 'dokumen_id', 'id');
    }
}
