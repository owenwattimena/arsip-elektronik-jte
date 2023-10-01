<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\InformasiService;
use App\Services\UserService;
use Illuminate\Http\Request;

class MainController extends Controller
{
    private UserService $userService;
    private InformasiService $infoService;
    public function __construct(UserService $userService, InformasiService $infoService)
    {
        $this->userService = $userService;
        $this->infoService = $infoService;
    }
    public function index()
    {
        $data['totalDosen'] = $this->userService->totalDosen();
        $data['totalPlp'] = $this->userService->totalPlp();
        $data['informasi'] = $this->infoService->get(infoAdmin: true);
        // dd($data);
        return view('dashboard.admin.beranda.index', $data);
    }
}
