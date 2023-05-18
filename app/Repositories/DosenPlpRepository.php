<?php
namespace App\Repositories;
use App\Models\DosenPlp;
use App\Models\DosenPlpProdi;

interface DosenPlpRepository{

    public function totalDosen():int;
    public function totalPlp():int;
    public function getDosenPlpById(int $id):DosenPlp;
    public function create($data):DosenPlp;
    public function update(int $id, array $data):bool;
    public function createDosenPlpProdi($data): DosenPlpProdi;
    public function updateDosenPlpProdi($data): bool;
    public function getDosenPlpProdi(int $dosenPlpId, int $prodiId): DosenPlpProdi;
}
