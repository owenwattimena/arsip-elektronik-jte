<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Services\DokumenService;
use Illuminate\Http\Request;

class DokumenController extends Controller
{
    private DokumenService $dokumenService;

    public function __construct(DokumenService $dokumenService)
    {
        $this->dokumenService = $dokumenService;
    }

    public function index()
    {
        $data['dokumen'] = $this->dokumenService->get(\Auth::user()->role);
        return view('dashboard.dosen-plp.dokumen.index', $data);
    }
}
