<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserPostRequest;
use App\Services\ProgramStudiService;
use App\Services\UserService;
use Illuminate\Http\Request;

class RegisterController extends Controller
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
        return view('auth.register', $data);
    }

    public function create(UserPostRequest $request)
    {
        if($this->userService->create($request->all()))
        {
            // return redirect('/');
            return redirect()->back()->with('alert', [
                'type' => 'success',
                'message' => 'Pendaftaran berhasil dilakukan.'
            ]);
        }
        return redirect()->back()->with('alert', [
            'type' => 'danger',
            'message' => 'Pendaftaran gagal dilakukan.'
        ]);
    }
}
