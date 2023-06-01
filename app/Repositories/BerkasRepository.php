<?php
namespace App\Repositories;
use App\Models\Berkas;
use App\Models\DetailBerkas;

interface BerkasRepository
{
    public function get(int $dosenPlpProdiId, int $tahunAkademikId, string $semester, string $type): Berkas|null;
    public function getById(int $id):Berkas|null;
    public function createDetailBerkas(array $data): DetailBerkas;
    public function create(array $data): Berkas;
    // public function updateDetailBerkas(int $id, array $detailBerkas) : bool;
    public function deleteDetailBerkas(int $berkasId):bool;
}
