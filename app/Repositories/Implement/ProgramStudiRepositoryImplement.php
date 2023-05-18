<?php

namespace App\Repositories\Implement;
use App\Models\DosenPlpProdi;
use App\Models\ProgramStudi;
use App\Repositories\ProgramStudiRepository;
use Illuminate\Database\Eloquent\Collection;

class ProgramStudiRepositoryImplement implements ProgramStudiRepository
{

    private ProgramStudi $prodi;
    private DosenPlpProdi $dosenPlpProdi;

    public function __construct(ProgramStudi $prodi, DosenPlpProdi $dosenPlpProdi)
    {
        $this->prodi = $prodi;
        $this->dosenPlpProdi = $dosenPlpProdi;
    }

    public function getAll(): Collection
    {
        return $this->prodi->all();
    }

    public function getById(int $id): ProgramStudi
    {
        // return $this->prodi->with('dosen')->where('id',$id)->get()->first();
        return $this->prodi->findOrFail($id);
    }
    public function getDosenProdi(int $dosenId): Collection
    {
        return $this->dosenPlpProdi->with('prodi')->where('dosen_plp_id', $dosenId)->get();
    }
    public function create(array $data): bool
    {
        if($this->prodi->create($data)) return true;
            return false;
    }
}
