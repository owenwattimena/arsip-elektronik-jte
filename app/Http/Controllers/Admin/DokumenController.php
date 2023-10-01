<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\AlertMessage;
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

    public function suratKetetapan()
    {
        $data['jenisDokumen'] = "SK Direktur";
        $data['jenis'] = 'sk';
        $data['dokumen'] = $this->dokumenService->getAll(jenis: 'sk');
        return view('dashboard.admin.dokumen.index', $data);
    }
    public function suratTugas()
    {
        $data['jenisDokumen'] = "Surat Tugas";
        $data['jenis'] = 'surat_tugas';
        $data['dokumen'] = $this->dokumenService->getAll(jenis: 'surat_tugas');
        return view('dashboard.admin.dokumen.index', $data);
    }
    public function index()
    {
        $data['dokumen'] = $this->dokumenService->getAll();
        return view('dashboard.admin.dokumen.index', $data);
    }

    public function create(Request $request)
    {
        $request->validate([
            'dokumen' => 'required',
            'dilihat_oleh' => 'required'
        ]);
        // dd($request->all());

        try {
            if($this->dokumenService->create($request->except(['_token'])))
            {
                return redirect()->back()->with(AlertMessage::success('Berhasil mengunggah dokumen'));
            }
            return redirect()->back()->with(AlertMessage::danger('Gagal mengunggah dokumen'));

        } catch (\Exception $e) {
            return redirect()->back()->with(AlertMessage::danger('Gagal mengunggah dokumen. ' . $e->getMessage()));
        }
    }
}
