<?php
namespace App\Services\Implement;
use App\Models\ProgramStudi;
use App\Repositories\ProgramStudiRepository;
use App\Services\ProgramStudiService;
use Illuminate\Database\Eloquent\Collection;

class ProgramStudiServiceImplement implements ProgramStudiService
{

    private ProgramStudiRepository $repo;

    public function __construct(ProgramStudiRepository $repo)
    {
        $this->repo = $repo;
    }
    public function getAll(): Collection
    {
        return $this->repo->getAll();
    }
    public function getById(int $id): ProgramStudi
    {
        return $this->repo->getById($id);
    }
    public function getDosenProdi(int $dosenId): Collection
    {
        return $this->repo->getDosenProdi($dosenId);
    }
        public function create(array $data): bool
    {
        return $this->repo->create($data);
    }
}
