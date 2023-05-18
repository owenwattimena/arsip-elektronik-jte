<?php
namespace App\Repositories;
use App\Models\Pengaturan;
interface PengaturanRepository
{
    public function getFirst():Pengaturan|null;
    public function create(array $data): Pengaturan;
    public function update(int $id, array $data): bool;
}
