<?php
namespace App\Repositories\Implement;
use App\Models\Dokumen;
use App\Repositories\DokumenRepository;
use Illuminate\Database\Eloquent\Collection;
class DokumenRepositoryImplement implements DokumenRepository
{
    private Dokumen $dokumenModel;

    public function __construct(Dokumen $dokumenModel)
    {
        $this->dokumenModel = $dokumenModel;
    }
    public function getAll():Collection{
        return $this->dokumenModel->all();
    }
    public function get(string $role):Collection
    {
        return $this->dokumenModel->where('dilihat_oleh', 'all')->orWhere('dilihat_oleh', $role)->get();
    }
    public function create(array $data):Dokumen
    {
        return $this->dokumenModel->create($data);
    }
}
