<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailBerkas extends Model
{
    use HasFactory;
    protected $table = 'detail_berkas';
    public $timestamps = false;

    protected $fillable = [
        'berkas_id',
        'berkas'
    ];
}
