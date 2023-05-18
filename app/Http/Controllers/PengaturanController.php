<?php

namespace App\Http\Controllers;

use App\Helpers\AlertMessage;
use App\Services\PengaturanService;
use Illuminate\Http\Request;

class PengaturanController extends Controller
{
    private PengaturanService $service;
    public function __construct(PengaturanService $service)
    {
        $this->service = $service;
    }
    public function index()
    {
        $data['pengaturan'] = $this->service->getFirst();
        return view('profile', $data);
    }

    public function createOrUpdate(Request $request)
    {
        $request->validate(
            [
                'profile' => 'required'
            ]
        );

        if($this->service->createOrUpdate($request->except(['_token']))){
            return redirect()->back()->with(AlertMessage::success('Profile barhasil di perbarui.'));
        }
        return redirect()->back()->with(AlertMessage::danger('Profile gagal di perbarui.'));
    }
}
