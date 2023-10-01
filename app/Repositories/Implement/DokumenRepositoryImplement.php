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
    public function getAll(?string $jenis=null):Collection{
        $query = $this->dokumenModel->query();
        if($jenis)
        {
            $query = $query->where('jenis', $jenis);
        }
        return $query->get();
    }
    public function get(string $role, ?string $jenis=null):Collection
    {
        $query = $this->dokumenModel->query();
        $query = $query->where('dilihat_oleh', 'all')->orWhere('dilihat_oleh', $role)->orWhere('dilihat_oleh', "${role}_all");
        // if($role == 'dosen')
        // {
        //     $query = $query->where('dilihat_oleh', 'dosen_all');
        // }

        // if($jenis != null)
        // {
        //     $query = $query->where('jenis', $jenis);
        // }
        $result = $query->get();
        if($jenis != null)
        {
            $result = $result->where('jenis', $jenis);
        }
        // dd($result);
        return $result;
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
