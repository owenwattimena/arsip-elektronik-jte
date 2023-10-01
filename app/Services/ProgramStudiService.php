<?php

namespace App\Services;
use Illuminate\Database\Eloquent\Collection;

interface ProgramStudiService{
    public function getAll(bool $withPlp = true): Collection;
    public function getById(int $id): \App\Models\ProgramStudi;
    public function getDosenProdi(int $dosenId): Collection;
    public function create(array $data): bool;
}
