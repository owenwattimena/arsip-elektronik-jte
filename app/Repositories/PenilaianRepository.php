<?php
namespace App\Repositories;
use App\Models\Penilaian;

interface PenilaianRepository
{
    public function create(array $data): Penilaian;
}
