<?php
namespace App\Services\Implement;
use App\Models\Berkas;
use App\Repositories\BerkasRepository;
use App\Services\BerkasService;
use Illuminate\Support\Facades\Storage;

class BerkasServiceImplement implements BerkasService
{
    private BerkasRepository $repo;
    public function __construct(BerkasRepository $repo)
    {
        $this->repo = $repo;
    }
    public function get(int $dosenPlpProdiId, int $tahunAkademikId, string $semester, string $type): Berkas|null
    {
        return $this->repo->get($dosenPlpProdiId, $tahunAkademikId, $semester, $type);
    }
    public function create(array $data): bool
    {
        $berkas = $data['berkas'];
        $fileName = round(microtime(true) * 1000) . '.' . $berkas->getClientOriginalExtension();
        $filePath = '';
        switch ($data['jenis_berkas']) {
            case 'bkd':
                $berkas->storeAs(config('app.file_bkd_url'), $fileName);
                $filePath = config('app.file_bkd_url') . '/' . $fileName;
                $data['berkas'] = $filePath;
                break;
            case 'lkd':
                $berkas->storeAs(config('app.file_lkd_url'), $fileName);
                $filePath = config('app.file_lkd_url') . '/' . $fileName;
                $data['berkas'] = $filePath;
                break;
            case 'skp':
                $berkas->storeAs(config('app.file_skp_url'), $fileName);
                $filePath = config('app.file_skp_url') . '/' . $fileName;
                $data['berkas'] = $filePath;
                break;
        }
        if($this->repo->create($data)) return true;
            $this->deleteFile($filePath);
            return false;
    }

    protected function deleteFile(
        string $filePath
    ) {
        if (Storage::exists($filePath)) {
            Storage::delete($filePath);
        }
    }
}
