<?php
namespace App\Repositories\Implement;
use App\Models\Berkas;
use App\Repositories\BerkasRepository;

class BerkasRepositoryImplement implements BerkasRepository
{
    private Berkas $model;
    public function __construct(Berkas $model)
    {
        $this->model = $model;
    }
    public function get(int $dosenPlpProdiId, int $tahunAkademikId, string $semester, string $type): Berkas|null
    {
        return $this->model
            ->where('dosen_plp_prodi_id', $dosenPlpProdiId)
            ->where('tahun_akademik_id', $tahunAkademikId)
            ->where('semester', $semester)
            ->where('jenis_berkas', $type)
            ->first();
    }
    public function create(array $data): Berkas
    {
        return $this->model->create($data);
    }
}