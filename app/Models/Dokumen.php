<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Dokumen extends Model
{
    use HasFactory;
    protected $table = 'dokumen';

    protected $fillable = [
        'dokumen',
        'dilihat_oleh'
    ];

    /**
     * Get the akses associated with the Dokumen
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function akses(): HasOne
    {
        return $this->hasOne(DokumenAkses::class, 'dokumen_id', 'id');
    }
}
