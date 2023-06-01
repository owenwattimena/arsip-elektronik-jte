<?php
namespace App\Repositories\Implement;
use App\Models\Berkas;
use App\Models\DetailBerkas;
use App\Repositories\BerkasRepository;

class BerkasRepositoryImplement implements BerkasRepository
{
    private Berkas $model;
    private DetailBerkas $modelDetailBerkas;
    public function __construct(Berkas $model, DetailBerkas $modelDetailBerkas)
    {
        $this->model = $model;
        $this->modelDetailBerkas = $modelDetailBerkas;
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
    public function getById(int $id):Berkas|null
    {
        return $this->model->findOrFail($id);
    }
    public function create(array $data): Berkas
    {
        return $this->model->create($data);
    }

    // public function updateDetailBerkas(int $id, array $detailBerkas) : bool
    // {

    //     if($this->createDetailBerkas($detailBerkas)) return true;
    //         return false;
    // }

    public function createDetailBerkas(array $data):DetailBerkas{
        return $this->modelDetailBerkas->create($data);
    }

    public function deleteDetailBerkas(int $berkasId) : bool
    {
        return $this->modelDetailBerkas->where('berkas_id', $berkasId)->delete() > 0;
    }
}
