<?php
namespace App\Services\Implement;
use App\Repositories\TahunAkademikRepository;
use App\Services\TahunAkademikService;
use \Illuminate\Database\Eloquent\Collection;

class TahunAkademikServiceImplement implements TahunAkademikService
{
    private TahunAkademikRepository $tahunAkademikRepo;

    public function __construct(TahunAkademikRepository $tahunAkademikRepo)
    {
        $this->tahunAkademikRepo = $tahunAkademikRepo;
    }
    public function getAll():Collection
    {
        return $this->tahunAkademikRepo->getAll();
    }
    public function create(array $data): bool
    {
        if($this->tahunAkademikRepo->create($data)) return true;
            return false;
    }
}
