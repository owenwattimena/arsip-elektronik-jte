<?php

namespace App\Repositories\Implement;

use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Database\Eloquent\Collection;

class UserRepositoryImplement implements UserRepository
{

    private User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function create(array $data): User
    {
        return $this->user->create($data);
    }
    public function update(int $id, array $data): bool
    {
        $user = $this->user->findOrFail($id);
        return $user->update($data) > 0;
    }
    public function delete(int $id): bool
    {
        return false;
    }
    public function getAll(): Collection
    {
        return $this->user->all();
    }
    public function get(?string $role) : Collection
    {
        $query = $this->user->query();
        if($role)
        {
            $query->where('role', $role);
        }
        return $query->get();
    }
    public function findById(int $id): User
    {
        return User::findOrFail($id);
    }

    public function changePassword(int $id, string $password):bool
    {
        $user = $this->user->findOrFail($id);
        $user->password = $password;
        return $user->save();
    }
}
