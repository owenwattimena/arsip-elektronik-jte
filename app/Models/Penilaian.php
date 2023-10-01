<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Penilaian extends Model
{
    use HasFactory;
    protected $table = 'penilaian';

    protected $fillable = [
        "berkas_id",
        "nilai",
        "catatan",
        "created_by",
    ];

    /**
     * Get the berkas that owns the Penilaian
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function berkas(): BelongsTo
    {
        return $this->belongsTo(Berkas::class, 'berkas_id', 'id');
    }
}
