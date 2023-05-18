<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\AlertMessage;
use App\Http\Controllers\Controller;
use App\Services\ProgramStudiService;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private UserService $userService;
    private ProgramStudiService $prodiService;
    public function __construct(UserService $userService, ProgramStudiService $prodiService)
    {
        $this->userService = $userService;
        $this->prodiService = $prodiService;
    }

    public function index()
    {
        $data['prodi'] = $this->prodiService->getAll();
        $data['users'] = $this->userService->getAll();
        return view('dashboard.admin.user.index', $data);
    }

    public function create(Request $request)
    {
        if($this->userService->create($request->all()))
        {
            return redirect()->back()->with(AlertMessage::success('Berhasil menambahkan user.'));
        }
        return redirect()->back()->with(AlertMessage::danger('Gagal menambahkan user.'));
    }
}

