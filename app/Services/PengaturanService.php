<?php
namespace App\Services;
use App\Models\Pengaturan;
interface PengaturanService
{
    public function getFirst(): Pengaturan|null;
    public function createOrUpdate(array $data): bool;
}
