<?php
namespace App\Repositories\Implement;
use App\Repositories\TahunAkademikRepository;
use App\Models\TahunAkademik;
use Illuminate\Database\Eloquent\Collection;
class TahunAkademikRepositoryImplement implements TahunAkademikRepository
{

    private TahunAkademik $tahunAkademikModel;
    public function __construct(TahunAkademik $tahunAkademikModel)
    {
        $this->tahunAkademikModel = $tahunAkademikModel;
    }
    public function getAll():Collection
    {
        return $this->tahunAkademikModel->all();
    }
    public function create(array $data): TahunAkademik
    {
        return $this->tahunAkademikModel->create($data);
    }
}
