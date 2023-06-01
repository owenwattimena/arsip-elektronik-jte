<?php
namespace App\Services\Implement;
use App\Repositories\InformasiRepository;
use App\Services\InformasiService;
use Illuminate\Database\Eloquent\Collection;

class InformasiServiceImplement implements InformasiService
{
    protected InformasiRepository $informasiRepo;
    public function __construct(InformasiRepository $informasiRepo)
    {
        $this->informasiRepo = $informasiRepo;
    }
    public function get(
        ?int $limit = 10,
        ?bool $pemberitahuan = false,
        ?bool $infoDosenPlp = false,
        ?bool $infoAdmin = false,
        ?int $dosenPlpId = null
    ) : Collection
    {
        return $this->informasiRepo->get($limit, $pemberitahuan, $infoDosenPlp, $infoAdmin, $dosenPlpId);
    }
    public function create(array $data, ?string $tipe = 'pemberitahuan') : bool
    {
        $data['created_by'] = \Auth::user()->id;
        $data['tipe'] = $tipe;
        if($this->informasiRepo->create($data))return true;
            return false;
    }
    public function delete(int|array $ids):bool
    {
        return $this->informasiRepo->delete($ids);
    }
}
