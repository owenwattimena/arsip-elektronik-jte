<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\AlertMessage;
use App\Http\Controllers\Controller;
use App\Services\InformasiService;
use Illuminate\Http\Request;

class PemberitahuanController extends Controller
{
    protected InformasiService $informasiService;
    public function __construct(InformasiService $informasiService)
    {
        $this->informasiService = $informasiService;
    }
    public function index()
    {
        $data['pemberitahuan'] = $this->informasiService->get(pemberitahuan:true);
        return view("dashboard.admin.pemberitahuan.index",$data);
    }

    public function create(Request $request)
    {
        $request->validate(['deskripsi'=>'required']);

        if($this->informasiService->create($request->except(['_token']), tipe: "pemberitahuan"))
        {
            return redirect()->back()->with(AlertMessage::success('Pemberitahuan berhasil dibuat'));
        }
        return redirect()->back()->with(AlertMessage::danger('Pemberitahuan gagal dibuat'));
    }

    public function delete(Request $request)
    {
        $id = $request->id;

        if($this->informasiService->delete($id))
        {
            return redirect()->back()->with(AlertMessage::success('Pemberitahuan berhasil dihapus'));
        }
        return redirect()->back()->with(AlertMessage::danger('Pemberitahuan gagal dihapus'));
    }
}
