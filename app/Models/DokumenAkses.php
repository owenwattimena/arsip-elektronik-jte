<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DokumenAkses extends Model
{
    use HasFactory;
    protected $table = 'dokumen_akses';
    public $timestamps = false;

    protected $fillable = [
        'dokumen_id',
        'dosen_plp_id',
    ];

    /**
     * Get the dosenPlp that owns the DokumenAkses
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function dosenPlp(): BelongsTo
    {
        return $this->belongsTo(DosenPlp::class, 'dosen_plp_id', 'id');
    }
}
