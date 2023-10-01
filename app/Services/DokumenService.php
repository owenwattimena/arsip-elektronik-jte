<?php
namespace App\Services;
use Illuminate\Database\Eloquent\Collection;
interface DokumenService
{
    public function getAll(?string $jenis=null):Collection;
    public function get(string $role,?string $jenis=null):Collection;
    public function create(array $data): bool;
}
