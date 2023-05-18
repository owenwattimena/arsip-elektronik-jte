<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Http\Request;

class MainController extends Controller
{
    private UserService $userService;
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    public function index()
    {
        $data['totalDosen'] = $this->userService->totalDosen();
        $data['totalPlp'] = $this->userService->totalPlp();
        return view('dashboard.admin.beranda.index', $data);
    }
}
