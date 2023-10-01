<?php
namespace App\Services\Implement;

use App\Repositories\DokumenRepository;
use App\Services\DokumenService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DokumenServiceImplement implements DokumenService
{

    private DokumenRepository $dokumenRepo;

    public function __construct(DokumenRepository $dokumenRepo)
    {
        $this->dokumenRepo = $dokumenRepo;
    }

    public function getAll(?string $jenis=null): Collection
    {
        return $this->dokumenRepo->getAll(jenis: $jenis);
    }
    public function get(string $role, ?string $jenis=null): Collection
    {
        return $this->dokumenRepo->get($role, jenis: $jenis);
    }
    public function create(array $data): bool
    {
        return DB::transaction(function () use ($data) {
            if (isset($data['dokumen'])) {
                $dokumen = $data['dokumen'];
                $namaDokumen = $dokumen->getClientOriginalName();
                $dokumen->storeAs(config('app.dokumen_url'), $namaDokumen);

                $dataDokumen['dokumen'] = config('app.dokumen_url') . '/' . $namaDokumen;
            }
            $dataDokumen['jenis'] = $data['jenis'];
            $dataDokumen['dilihat_oleh'] = $data['dilihat_oleh'];
            if($dataDokumen['dilihat_oleh'] == 'dosen')
            {
                if(!isset($data['dosen_plp_id']))
                {
                    if($dataDokumen['dilihat_oleh'] != 'all')
                    {
                        $dataDokumen['dilihat_oleh'] = $data['dilihat_oleh'] . '_all';
                    }
                    // throw new \Exception("Silahkan pilih dosen terlebih dahulu.");
                }
            }
            $dokumen = $this->dokumenRepo->create($dataDokumen);
            if ($dokumen){
                if(isset($data['dosen_plp_id'])){
                    for ($i=0; $i < count($data['dosen_plp_id']); $i++) {
                        $dokumenAkses['dosen_plp_id'] = $data['dosen_plp_id'][$i];
                        $dokumenAkses['dokumen_id'] = $dokumen->id;
                        $this->dokumenRepo->createDocumentAccess($dokumenAkses);
                    }
                }
                return true;
            }
            $this->deleteFile($data['dokumen']);
            return false;
        });
    }

    protected function deleteFile(
        string $filePath
    ) {
        if (Storage::exists($filePath)) {
            Storage::delete($filePath);
        }
    }
}
