<?php

namespace App\Repositories;

use App\Models\Informasi;
use Illuminate\Database\Eloquent\Collection;

interface InformasiRepository
{
    public function get(
        ?int $limit = 10,
        ?bool $pemberitahuan = false,
        ?bool $infoDosenPlp = false,
        ?bool $infoAdmin = false,
        ?int $dosenPlpId = null
    ): Collection;
    public function create(array $data): Informasi;
    public function delete(int|array $ids): bool;
}
