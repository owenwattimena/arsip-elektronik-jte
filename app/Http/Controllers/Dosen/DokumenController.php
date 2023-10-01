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

    public function suratKeterangan()
    {
        $data['jenisDokumen'] = "SK Direktur";
        $data['dokumen'] = $this->dokumenService->get(\Auth::user()->role, jenis:'sk');
        // dd($data);
        return view('dashboard.dosen-plp.dokumen.index', $data);
    }
    public function suratTugas()
    {
        $data['jenisDokumen'] = "Surat Tugas";
        $data['dokumen'] = $this->dokumenService->get(\Auth::user()->role, jenis: 'surat_tugas');
        return view('dashboard.dosen-plp.dokumen.index', $data);
    }
    public function index()
    {
        $data['dokumen'] = $this->dokumenService->get(\Auth::user()->role);
        return view('dashboard.dosen-plp.dokumen.index', $data);
    }
}
