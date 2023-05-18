<?php
namespace App\Repositories;
use App\Models\Berkas;

interface BerkasRepository
{
    public function get(int $dosenPlpProdiId, int $tahunAkademikId, string $semester, string $type): Berkas|null;
    public function create(array $data): Berkas;
}