<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\AlertMessage;
use App\Http\Controllers\Controller;
use App\Services\ProgramStudiService;
use Illuminate\Http\Request;

class ProgramStudiController extends Controller
{
    private ProgramStudiService $prodiService;
    public function __construct(ProgramStudiService $prodiService)
    {
        $this->prodiService = $prodiService;
    }

    public function index()
    {
        $data['prodi'] = $this->prodiService->getAll(false);
        return view('dashboard.admin.prodi.index', $data);
    }

    public function create(Request $request)
    {
        $request->validate([
            'program_studi' => 'required'
        ]);

        if($this->prodiService->create($request->all()))
        {
            return redirect()->back()->with(AlertMessage::success('Berhasil menambahkan prodi.'));
        }
        return redirect()->back()->with(AlertMessage::danger('Gagal menambahkan prodi.'));
    }
}
