<?php

namespace App\Services;
use Illuminate\Database\Eloquent\Collection;

interface ProgramStudiService{
    public function getAll(): Collection;
    public function getById(int $id): \App\Models\ProgramStudi;
    public function getDosenProdi(int $dosenId): Collection;
    public function create(array $data): bool;
}
