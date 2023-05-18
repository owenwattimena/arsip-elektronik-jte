<?php
namespace App\Repositories;
use App\Models\TahunAkademik;
use Illuminate\Database\Eloquent\Collection;

interface TahunAkademikRepository
{
    public function getAll():Collection;
    public function create(array $data): TahunAkademik;
}
