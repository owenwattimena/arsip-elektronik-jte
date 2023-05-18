<?php
namespace App\Repositories;
use App\Models\Dokumen;
use Illuminate\Database\Eloquent\Collection;
interface DokumenRepository
{
    public function getAll():Collection;
    public function get(string $role):Collection;
    public function create(array $data): Dokumen;
}
