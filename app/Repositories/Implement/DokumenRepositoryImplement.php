<?php
namespace App\Repositories\Implement;
use App\Models\Dokumen;
use App\Models\DokumenAkses;
use App\Repositories\DokumenRepository;
use Illuminate\Database\Eloquent\Collection;
class DokumenRepositoryImplement implements DokumenRepository
{
    private Dokumen $dokumenModel;
    private DokumenAkses $dokumenAksesModel;

    public function __construct(Dokumen $dokumenModel, DokumenAkses $dokumenAksesModel)
    {
        $this->dokumenModel = $dokumenModel;
        $this->dokumenAksesModel = $dokumenAksesModel;
    }
    public function getAll():Collection{
        return $this->dokumenModel->all();
    }
    public function get(string $role):Collection
    {
        return $this->dokumenModel->where('dilihat_oleh', 'all')->orWhere('dilihat_oleh', $role)->get();
        // return $this->dokumenModel->where('dilihat_oleh', 'all')->with(["akses"=>function($query){
        //     return $query->where('dosen_plp_id', 2)->get();
        // }])->get();
    }
    public function create(array $data):Dokumen
    {
        return $this->dokumenModel->create($data);
    }
    public function createDocumentAccess(array $data): DokumenAkses
    {
        return $this->dokumenAksesModel->create($data);
    }
}
