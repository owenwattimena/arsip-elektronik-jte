<?php
namespace App\Services;
interface PenilaianService
{
    public function create(array $data):bool;
    public function delete(int $berkasId):bool;
}
