<?php

namespace App\Http\Controllers\Dosen;

use App\Helpers\AlertMessage;
use App\Http\Controllers\Controller;
use App\Services\BerkasService;
use App\Services\ProgramStudiService;
use App\Services\TahunAkademikService;
use App\Services\UserService;
use Illuminate\Http\Request;

class PenilaianController extends Controller
{
    private TahunAkademikService $tahunAkademikService;
    private ProgramStudiService $prodiService;
    private BerkasService $berkasService;
    private UserService $userService;

    public function __construct(
        TahunAkademikService $tahunAkademikService,
        ProgramStudiService $prodiService,
        BerkasService $berkasService,
        UserService $userService
        )
    {
        $this->tahunAkademikService = $tahunAkademikService;
        $this->prodiService = $prodiService;
        $this->berkasService = $berkasService;
        $this->userService = $userService;
    }
    public function index(Request $request, int $prodiId)
    {
        $data['tahunAkademikId'] = null;
        $data['semester'] = null;
        $dosenPlpProdi = $this->userService->getDosenPlpProdi(\Auth::user()->dosenPlp->id, $prodiId);
        $data['dosenPlpProdiId'] = $dosenPlpProdi->id;
        if($request->query())
        {
            $tahunAkademikId = $request->query('tahun_akademik_id');
            $semester = $request->query('semester');
            $data['tahunAkademikId'] = $tahunAkademikId;
            $data['semester'] = $semester;
            $data['bkd'] = $this->berkasService->get($dosenPlpProdi->id, $tahunAkademikId, $semester, 'bkd');
            $data['lkd'] = $this->berkasService->get($dosenPlpProdi->id, $tahunAkademikId, $semester, 'lkd');
            $data['skp'] = $this->berkasService->get($dosenPlpProdi->id, $tahunAkademikId, $semester, 'skp');
        }
        $data['prodi'] = $this->prodiService->getById($prodiId);
        $data['tahunAkademik'] = $this->tahunAkademikService->getAll();
        return view('dashboard.dosen-plp.penilaian.index', $data);
    }

    public function create(Request $request, int $prodiId)
    {
        $request->validate([
            'berkas'=> 'required'
        ]);
        if($this->berkasService->create($request->except(['_token'])))
        {
            return redirect()->back()->with(AlertMessage::success('Berhasil mengunggah berkas.'));
        }
        return redirect()->back()->with(AlertMessage::danger('Gagal mengunggah berkas.'));
    }

    public function update(Request $request, int $prodiId, int $berkasId)
    {
        $request->validate(['berkas'=>'required']);

        if($this->berkasService->update($berkasId, $request->except(['_token', '_method'])))
        {
            return redirect()->back()->with(AlertMessage::success('Berhasil mengunggah ulang berkas.'));
        }
        return redirect()->back()->with(AlertMessage::danger('Gagal mengunggah ulang berkas.'));
    }
 }
