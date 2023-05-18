<?php
namespace App\Services;
use Illuminate\Database\Eloquent\Collection;
interface DokumenService
{
    public function getAll():Collection;
    public function get(string $role):Collection;
    public function create(array $data): bool;
}
