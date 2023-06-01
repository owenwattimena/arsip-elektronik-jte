<?php
namespace App\Services;
use Illuminate\Database\Eloquent\Collection;

interface InformasiService
{
    public function get(
        ?int $limit = 10,
        ?bool $pemberitahuan = false,
        ?bool $infoDosenPlp = false,
        ?bool $infoAdmin = false,
        ?int $dosenPlpId = null
    ) : Collection;
    public function create(array $data, ?string $tipe = 'pemberitahuan') : bool;
    public function delete(int|array $ids):bool;
}
