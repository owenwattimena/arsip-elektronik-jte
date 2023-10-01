<?php
namespace App\Services\Implement;

use App\Models\Penilaian;
use App\Repositories\PenilaianRepository;
use App\Services\InformasiService;
use App\Services\PenilaianService;
use Illuminate\Support\Facades\DB;

class PenilaianServiceImplement implements PenilaianService
{
    private PenilaianRepository $repo;
    protected InformasiService $infoService;
    public function __construct(PenilaianRepository $repo, InformasiService $infoService)
    {
        $this->repo = $repo;
        $this->infoService = $infoService;
    }
    public function create(array $data): bool
    {
        return DB::transaction(function()use ($data){
            // return false;
            // if (is_string($data['terpenuhi'])) {
            //     $data['terpenuhi'] = $data['terpenuhi'] == 'true';
            // }
            $data['created_by'] = \Auth::user()->id;
            $result = $this->repo->create($data);
            if ($result) {
                $dokumen = $result->berkas->jenis_berkas;
                $prodi = $result->berkas->dosenPlpProdi->prodi->program_studi;
                $tahunAkademik = $result->berkas->tahunAkademik->tahun_akademik;
                $semester = $result->berkas->semester;
                // $nilai = $result->terpenuhi == true ? 'terpenuhi' : 'tidak terpenuhi';
                $nilai = $result->nilai;

                $dosenPlpId = $result->berkas->dosenPlpProdi->dosenPlp->id;
                $info = [
                    'deskripsi' => "Dokumen $dokumen program studi $prodi tahun akademik $tahunAkademik semester $semester telah dinilai $nilai",
                    'dosen_plp_id' => $dosenPlpId
                ];
                $this->infoService->create($info, tipe: 'info_dosen_plp');
                return true;
            }
            return false;
        });
    }

    public function delete(int $berkasId) : bool
    {
        return $this->repo->delete($berkasId);
    }
}
