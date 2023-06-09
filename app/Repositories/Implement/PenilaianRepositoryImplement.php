<?php
namespace App\Repositories\Implement;
use App\Models\Penilaian;
use App\Repositories\PenilaianRepository;

class PenilaianRepositoryImplement implements PenilaianRepository
{
    private Penilaian $model;
    public function __construct(Penilaian $model)
    {
        $this->model = $model;
    }
    public function create(array $data): Penilaian
    {
        return $this->model->create($data);
    }

    public function delete(int $berkasId):bool{
        return $this->model->where('berkas_id', $berkasId)->delete() > 0;
    }
}
