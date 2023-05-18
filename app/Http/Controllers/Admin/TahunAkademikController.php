<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\AlertMessage;
use App\Http\Controllers\Controller;
use App\Services\TahunAkademikService;
use Illuminate\Http\Request;

class TahunAkademikController extends Controller
{
    private TahunAkademikService $tahunAkademikService;
    public function __construct(TahunAkademikService $tahunAkademikService)
    {
        $this->tahunAkademikService = $tahunAkademikService;
    }

    public function index()
    {
        $data['tahunAkademik'] = $this->tahunAkademikService->getAll();
        return view('dashboard.admin.tahun-akademik.index', $data);
    }

    public function create(Request $request)
    {
        $request->validate([
            'tahun_akademik' => 'required'
        ]);


        if($this->tahunAkademikService->create($request->except('_token')))
        {
            return redirect()->back()->with(AlertMessage::success('Berhasil menambahkan tahun akademik.'));
        }
        return redirect()->back()->with(AlertMessage::danger('Gagal menambahkan tahun akademik.'));
    }
}
