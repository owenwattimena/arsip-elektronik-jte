<?php

namespace App\Repositories\Implement;
use App\Models\Informasi;
use App\Repositories\InformasiRepository;
use Illuminate\Database\Eloquent\Collection;

class InformasiRepositoryImplement implements InformasiRepository
{

    protected Informasi $informasiModel;

    public function __construct(Informasi $informasiModel)
    {
        $this->informasiModel = $informasiModel;
    }

    public function get(
        ?int $limit = 10,
        ?bool $pemberitahuan = false,
        ?bool $infoDosenPlp = false,
        ?bool $infoAdmin = false,
        ?int $dosenPlpId = null
    ) : Collection
    {
        $query = $this->informasiModel->query();
        if($pemberitahuan)
        {
            if($infoDosenPlp)
            {
                if($infoAdmin)
                {
                    $query = $query->where('tipe', 'pemberitahuan')
                        ->orWhere('tipe', 'info_dosen_plp')
                        ->orWhere('tipe', 'info_admin');
                }else{
                    $query = $query->where('tipe', 'pemberitahuan')
                        ->orWhere('tipe', 'info_dosen_plp');
                }
            }else{
                if($infoAdmin)
                {
                    $query = $query->where('tipe', 'pemberitahuan')
                        ->orWhere('tipe', 'info_admin');
                }else{
                    $query = $query->where('tipe', 'pemberitahuan');
                }
            }
        }
        else{
            if($infoDosenPlp)
            {
                if($infoAdmin)
                {
                    $query = $query->Where('tipe', 'info_dosen_plp')
                        ->orWhere('tipe', 'info_admin');
                }else{
                    $query = $query->Where('tipe', 'info_dosen_plp');
                }
            }else{
                if($infoAdmin)
                {
                    $query = $query->Where('tipe', 'info_admin');
                }
            }
        }
        if($dosenPlpId)
        {
            $query = $query->where('dosen_plp_id', $dosenPlpId);
        }
        return $query->orderBy('created_at', 'desc')->limit($limit)->get();
    }
    public function create(array $data) : Informasi
    {
        return $this->informasiModel->create($data);
    }
    public function delete(int|array $ids):bool
    {
        return $this->informasiModel->destroy($ids) > 0;
    }
}
