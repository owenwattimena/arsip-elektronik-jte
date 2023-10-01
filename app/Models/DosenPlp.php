<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DosenPlp extends Model
{
    use HasFactory;
    protected $table = 'dosen_plp';

    protected $fillable = [
        'user_id',
        'nama_lengkap',
        'nip',
        'jabatan_fungsional',
        'pangkat_golongan',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'agama',
        'alamat',
        'telepon',
        'email',
        'foto',
    ];

    public $timestamps = false;

    /**
     * Get the user that owns the DosenPlp
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
