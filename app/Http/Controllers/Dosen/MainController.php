<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Services\InformasiService;
use Illuminate\Http\Request;

class MainController extends Controller
{
    protected InformasiService $informasiService;
    public function __construct(InformasiService $informasiService)
    {
        $this->informasiService = $informasiService;
    }
    public function index()
    {
        $data['informasi'] = $this->informasiService->get(pemberitahuan: true, infoDosenPlp:true, dosenPlpId: \Auth::user()->dosenPlp->id);
        return view('dashboard.dosen-plp.beranda.index', $data);
    }
}
