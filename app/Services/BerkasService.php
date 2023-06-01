<?php
namespace App\Services;
use App\Models\Berkas;

interface BerkasService
{
    public function get(int $dosenPlpProdiId, int $tahunAkademikId, string $semester, string $type): Berkas|null;
    public function create(array $data): bool;
    public function update(int $id, array $detailBerkas) : bool;
}
