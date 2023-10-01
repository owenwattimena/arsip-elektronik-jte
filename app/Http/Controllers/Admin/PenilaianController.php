<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\AlertMessage;
use App\Http\Controllers\Controller;
use App\Services\BerkasService;
use App\Services\PenilaianService;
use App\Services\ProgramStudiService;
use App\Services\TahunAkademikService;
use App\Services\UserService;
use Illuminate\Http\Request;

class PenilaianController extends Controller
{
    private TahunAkademikService $tahunAkademikService;
    private UserService $userService;
    private ProgramStudiService $programStudiService;
    private BerkasService $berkasService;
    private PenilaianService $penilaianService;
    public function __construct(
        TahunAkademikService $tahunAkademikService,
        UserService $userService,
        ProgramStudiService $programStudiService,
        BerkasService $berkasService,
        PenilaianService $penilaianService)
    {
        $this->tahunAkademikService = $tahunAkademikService;
        $this->userService = $userService;
        $this->programStudiService = $programStudiService;
        $this->berkasService = $berkasService;
        $this->penilaianService = $penilaianService;
    }

    public function index(int $id)
    {
        $data['prodi'] = $this->programStudiService->getById($id);
        return view('dashboard.admin.penilaian.index', $data);
    }

    public function nilai(Request $request, int $id, int $dosenPlpId)
    {
        $data['dosenPlp'] = $this->userService->getDosenPlpById($dosenPlpId);
        $data['prodi'] = $this->programStudiService->getById($id);
        $data['tahunAkademik'] = $this->tahunAkademikService->getAll();
        $data['tahunAkademikId'] = null;
        $data['semester'] = null;
        if($request->query())
        {
            $dosenPlpProdi = $this->userService->getDosenPlpProdi($dosenPlpId, $id);
            $data['dosenPlpProdiId'] = $dosenPlpProdi->id;
            $tahunAkademikId = $request->query('tahun_akademik_id');
            $semester = $request->query('semester');
            $data['tahunAkademikId'] = $tahunAkademikId;
            $data['semester'] = $semester;
            $data['bkd'] = $this->berkasService->get($dosenPlpProdi->id, $tahunAkademikId, $semester, 'bkd');
            $data['lkd'] = $this->berkasService->get($dosenPlpProdi->id, $tahunAkademikId, $semester, 'lkd');
            $data['skp'] = $this->berkasService->get($dosenPlpProdi->id, $tahunAkademikId, $semester, 'skp');
        }

        return view('dashboard.admin.penilaian.nilai', $data);
    }

    public function create(Request $request)
    {
        // dd($request->input());
        try {
            if($this->penilaianService->create($request->except(['_token', 'tahun_akademik_id', 'semester'])))
            {
                return redirect()->back()->with(AlertMessage::success('Penilaian berhasil dilakukan.'));
            }
            return redirect()->back()->with(AlertMessage::danger('Penilaian gagal dilakukan.'));
        } catch (\Exception $e) {
            return redirect()->back()->with(AlertMessage::danger('Penilaian gagal dilakukan. ' . $e->getMessage()));
        }
    }
}
