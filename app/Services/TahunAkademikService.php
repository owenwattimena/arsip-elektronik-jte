<?php

namespace App\Services;
use Illuminate\Database\Eloquent\Collection;

interface TahunAkademikService
{
    public function getAll():Collection;
    public function create(array $data): bool;
}
