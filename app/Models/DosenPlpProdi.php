<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class DosenPlpProdi extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'dosen_plp_prodi';

    protected $fillable = [
        'dosen_plp_id',
        'prodi_id'
    ];

    /**
     * Get all of the prodi for the DosenPlpProdi
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    // public function prodi(): HasMany
    // {
    //     return $this->hasMany(ProgramStudi::class, 'id', 'prodi_id');
    // }

    /**
     * Get the prodi associated with the DosenPlpProdi
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function prodi(): HasOne
    {
        return $this->hasOne(ProgramStudi::class, 'id', 'prodi_id');
    }

    /**
     * Get the dosenPlp associated with the DosenPlpProdi
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function dosenPlp(): HasOne
    {
        return $this->hasOne(DosenPlp::class, 'id', 'dosen_id');
    }
}
