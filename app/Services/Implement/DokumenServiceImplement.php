<?php
namespace App\Services\Implement;
use App\Repositories\DokumenRepository;
use App\Services\DokumenService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Storage;
class DokumenServiceImplement implements DokumenService
{

    private DokumenRepository $dokumenRepo;

    public function __construct(DokumenRepository $dokumenRepo)
    {
        $this->dokumenRepo = $dokumenRepo;
    }

    public function getAll():Collection
    {
        return $this->dokumenRepo->getAll();
    }
    public function get(string $role):Collection
    {
        return $this->dokumenRepo->get($role);
    }
    public function create(array $data): bool
    {
        if (isset($data['dokumen'])) {
            $dokumen = $data['dokumen'];
            $namaDokumen = $dokumen->getClientOriginalName();
            $dokumen->storeAs(config('app.dokumen_url'), $namaDokumen);

            $data['dokumen'] = config('app.dokumen_url') . '/' . $namaDokumen;
        }

        if($this->dokumenRepo->create($data))return true;
            $this->deleteFile($data['dokumen']);
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
