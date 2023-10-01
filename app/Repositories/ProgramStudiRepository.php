<?php

namespace App\Repositories;
use App\Models\ProgramStudi;
use Illuminate\Database\Eloquent\Collection;

interface ProgramStudiRepository{
    public function getAll(bool $withPlp = true): Collection;
    public function getById(int $id): ProgramStudi;
    public function getPlp(): ProgramStudi|null;
    public function getDosenProdi(int $dosenId): Collection;
    public function create(array $data): bool;
}
