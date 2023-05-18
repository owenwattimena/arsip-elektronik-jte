<?php

namespace App\Repositories;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface UserRepository{
    public function create(array $data): User;
    public function update(int $id, array $data): bool;
    public function delete(int $id): bool;
    public function getAll(): Collection;
    public function findById(int $id): User;
    public function changePassword(int $id, string $password):bool;
}
