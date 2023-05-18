<?php
namespace App\Repositories\Implement;
use App\Models\Pengaturan;
use App\Repositories\PengaturanRepository;
class PengaturanRepositoryImplement implements PengaturanRepository
{
    private Pengaturan $pengaturanModel;

    public function __construct(Pengaturan $pengaturanModel)
    {
        $this->pengaturanModel = $pengaturanModel;
    }
    public function getFirst():Pengaturan|null
    {
        return $this->pengaturanModel->get()->first();
    }
    public function create(array $data): Pengaturan
    {
        return $this->pengaturanModel->create($data);
    }
    public function update(int $id, array $data): bool
    {
        $pengaturan = $this->pengaturanModel->findOrFail($id);
        return $pengaturan->update($data) > 0;
    }
}
