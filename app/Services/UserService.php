<?php

namespace App\Services;
use App\Models\DosenPlp;
use App\Models\DosenPlpProdi;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface UserService{
    public function totalDosen():int;
    public function totalPlp():int;
    public function getDosenPlpById(int $id):DosenPlp;
    public function getDosenPlpProdi(int $dosenPlpId, int $prodiId): DosenPlpProdi;
    public function create(array $data): bool;
    public function updateDosenPlp(array $data): bool;
    public function delete(int $id): bool;
    public function getAll(): Collection;
    public function get(?string $role) : Collection;
    public function findById(int $id): User;
    public function changePassword(array $data):bool;
}
