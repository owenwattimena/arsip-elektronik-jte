<?php

namespace App\Models;

use App\Models\DosenPlp;
use App\Models\DosenPlpProdi;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ProgramStudi extends Model
{
    use HasFactory;
    protected $table = 'program_studi';

    protected $fillable = [
        'program_studi'
    ];

    /**
     * The dosen that belong to the ProgramStudi
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function dosen(): BelongsToMany
    {
        return $this->belongsToMany(DosenPlp::class, 'dosen_plp_prodi', 'prodi_id', 'dosen_plp_id');
    }
}
