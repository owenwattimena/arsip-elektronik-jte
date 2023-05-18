<?php
namespace App\Services\Implement;
use App\Models\Pengaturan;
use App\Repositories\PengaturanRepository;
use App\Services\PengaturanService;

class PengaturanServiceImplement implements PengaturanService
{
    private PengaturanRepository $repo;
    public function __construct(PengaturanRepository $repo)
    {
        $this->repo = $repo;
    }
    public function getFirst(): Pengaturan|null
    {
        return $this->repo->getFirst();
    }
    public function createOrUpdate(array $data): bool
    {
        $pengaturan = $this->getFirst();
        if($pengaturan)
        {
            return $this->repo->update($pengaturan->id, $data);
        }
        if($this->repo->create($data)) return true;
            return false;
    }
}
