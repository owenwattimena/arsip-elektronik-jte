<?php

namespace App\Repositories\Implement;
use App\Models\DosenPlp;
use App\Models\DosenPlpProdi;
use App\Models\User;
use App\Repositories\DosenPlpRepository;
use Faker\Provider\UserAgent;

class DosenPlpRepositoryImplement implements DosenPlpRepository
{

    private DosenPlp $model;
    private User $userModel;
    private DosenPlpProdi $dosenPlpProdiModel;

    public function __construct(
        DosenPlp $model,
        User $userModel,
        DosenPlpProdi $dosenPlpProdiModel)
    {
        $this->model = $model;
        $this->userModel = $userModel;
        $this->dosenPlpProdiModel = $dosenPlpProdiModel;
    }
    public function totalDosen():int
    {
        return $this->userModel->where('role', 'dosen')->get()->count();
    }
    public function totalPlp():int
    {
        return $this->userModel->where('role', 'plp')->get()->count();
    }
    public function getDosenPlpById(int $id):DosenPlp
    {
        return $this->model->findOrFail($id);
    }

    public function getDosenPlpProdi(int $dosenPlpId, int $prodiId): DosenPlpProdi
    {
        return $this->dosenPlpProdiModel
            // ->with('prodi')
            ->where('dosen_plp_id', $dosenPlpId)
            ->where('prodi_id', $prodiId)
            ->first();
    }
    public function create($data):DosenPlp
    {
        return $this->model->create($data);
    }
    public function update(int $id, array $data):bool
    {
        $dosenPlp = $this->model->findOrFail($id);
        return $dosenPlp->update($data) > 0;
    }
    public function createDosenPlpProdi($data): DosenPlpProdi
    {
        return $this->dosenPlpProdiModel->create($data);
    }
    public function updateDosenPlpProdi($data): bool
    {
        return false;
    }
}
