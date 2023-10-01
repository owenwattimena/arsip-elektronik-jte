<?php
namespace App\Repositories;
use App\Models\Dokumen;
use App\Models\DokumenAkses;
use Illuminate\Database\Eloquent\Collection;
interface DokumenRepository
{
    public function getAll(?string $jenis=null):Collection;
    public function get(string $role, ?string $jenis=null):Collection;
    public function create(array $data): Dokumen;
    public function createDocumentAccess(array $data): DokumenAkses;
}
