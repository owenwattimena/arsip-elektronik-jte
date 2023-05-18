<?php

namespace App\Repositories;
use App\Models\ProgramStudi;
use Illuminate\Database\Eloquent\Collection;

interface ProgramStudiRepository{
    public function getAll(): Collection;
    public function getById(int $id): ProgramStudi;
    public function getDosenProdi(int $dosenId): Collection;
    public function create(array $data): bool;
}
