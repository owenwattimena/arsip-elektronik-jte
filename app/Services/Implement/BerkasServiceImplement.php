<?php
namespace App\Services\Implement;

use App\Models\Berkas;
use App\Repositories\BerkasRepository;
use App\Repositories\InformasiRepository;
use App\Services\BerkasService;
use App\Services\PenilaianService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class BerkasServiceImplement implements BerkasService
{
    private BerkasRepository $repo;
    private InformasiRepository $infoRepo;
    private PenilaianService $penilaianService;
    public function __construct(BerkasRepository $repo, InformasiRepository $infoRepo, PenilaianService $penilaianService)
    {
        $this->repo = $repo;
        $this->infoRepo = $infoRepo;
        $this->penilaianService = $penilaianService;
    }
    public function get(int $dosenPlpProdiId, int $tahunAkademikId, string $semester, string $type): Berkas|null
    {
        return $this->repo->get($dosenPlpProdiId, $tahunAkademikId, $semester, $type);
    }
    public function create(array $data): bool
    {

        return DB::transaction(function () use ($data) {
            $berkas = $data['berkas'];
            unset($data['berkas']);
            $created = $this->repo->create($data);
            if (!$created)
                return false;
            foreach ($berkas as $key => $value) {
                $detailBerkas['berkas_id'] = $created->id;
                $fileName = round(microtime(true) * 1000) . '.' . $value->getClientOriginalExtension();
                $filePath = '';
                switch ($data['jenis_berkas']) {
                    case 'bkd':
                        $value->storeAs(config('app.file_bkd_url'), $fileName);
                        $filePath = config('app.file_bkd_url') . '/' . $fileName;
                        $detailBerkas['berkas'] = $filePath;
                        break;
                    case 'lkd':
                        $value->storeAs(config('app.file_lkd_url'), $fileName);
                        $filePath = config('app.file_lkd_url') . '/' . $fileName;
                        $detailBerkas['berkas'] = $filePath;
                        break;
                    case 'skp':
                        $value->storeAs(config('app.file_skp_url'), $fileName);
                        $filePath = config('app.file_skp_url') . '/' . $fileName;
                        $detailBerkas['berkas'] = $filePath;
                        break;
                }

                if (!$this->repo->createDetailBerkas($detailBerkas)) {
                    $this->deleteFile($filePath);
                }
            }

            $role = \Auth::user()->role;
            $nama = \Auth::user()->dosenPlp->nama_lengkap;
            $dokumen = $data['jenis_berkas'];
            $prodi = $created->dosenPlpProdi->prodi->program_studi;
            $tahunAkademik = $created->tahunAkademik->tahun_akademik;
            $semester = $created->semester;
            $info = [
                'deskripsi' => "$role $nama telah mengunggah dokumen $dokumen program studi $prodi tahun akademik $tahunAkademik semester $semester.",
                'created_by' => \Auth::id(),
                'tipe' => 'info_admin'
            ];
            $this->infoRepo->create($info);

            return true;
        });

    }

    public function update(int $id, array $data) : bool
    {
        // dd($detailBerkas);
        return DB::transaction(function () use ($id, $data) {
            $berkas = $this->repo->getById($id);
            $berkasDetail = $berkas->detail;
            $this->repo->deleteDetailBerkas($berkas->id);
            foreach ($data['berkas'] as $key => $value) {
                $detailBerkas['berkas_id'] = $berkas->id;
                $fileName = round(microtime(true) * 1000) . '.' . $value->getClientOriginalExtension();
                $filePath = '';
                switch ($data['jenis_berkas']) {
                    case 'bkd':
                        $value->storeAs(config('app.file_bkd_url'), $fileName);
                        $filePath = config('app.file_bkd_url') . '/' . $fileName;
                        $detailBerkas['berkas'] = $filePath;
                        break;
                    case 'lkd':
                        $value->storeAs(config('app.file_lkd_url'), $fileName);
                        $filePath = config('app.file_lkd_url') . '/' . $fileName;
                        $detailBerkas['berkas'] = $filePath;
                        break;
                    case 'skp':
                        $value->storeAs(config('app.file_skp_url'), $fileName);
                        $filePath = config('app.file_skp_url') . '/' . $fileName;
                        $detailBerkas['berkas'] = $filePath;
                        break;
                }

                if (!$this->repo->createDetailBerkas($detailBerkas)) {
                    $this->deleteFile($filePath);
                }
            }

            $role = \Auth::user()->role;
            $nama = \Auth::user()->dosenPlp->nama_lengkap;
            $dokumen = $data['jenis_berkas'];
            $prodi = $berkas->dosenPlpProdi->prodi->program_studi;
            $tahunAkademik = $berkas->tahunAkademik->tahun_akademik;
            $semester = $berkas->semester;
            $info = [
                'deskripsi' => "$role $nama telah mengunggah ulang dokumen $dokumen program studi $prodi tahun akademik $tahunAkademik semester $semester.",
                'created_by' => \Auth::id(),
                'tipe' => 'info_admin'
            ];
            $this->infoRepo->create($info);

            foreach ($berkasDetail as $key => $value) {
                $this->deleteFile($value->berkas);
            }
            $this->penilaianService->delete($berkas->id);
            return true;
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
