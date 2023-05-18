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

        if($this->dokumenService->create($request->except(['_token'])))
        {
            return redirect()->back()->with(AlertMessage::success('Berhasil mengunggah dokumen'));
        }
        return redirect()->back()->with(AlertMessage::danger('Gagal mengunggah dokumen'));
    }
}
