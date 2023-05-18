<?php
namespace App\Services\Implement;

use App\Repositories\PenilaianRepository;
use App\Services\PenilaianService;

class PenilaianServiceImplement implements PenilaianService
{
    private PenilaianRepository $repo;
    public function __construct(PenilaianRepository $repo)
    {
        $this->repo = $repo;
    }
    public function create(array $data): bool
    {
        if (is_string($data['terpenuhi'])) {
            $data['terpenuhi'] = $data['terpenuhi'] == 'true';
        }
        $data['created_by'] = \Auth::user()->id;
        if ($this->repo->create($data))
            return true;
        return false;
    }
}
