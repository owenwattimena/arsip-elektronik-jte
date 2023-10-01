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
        $data['prodi'] = $this->prodiService->getAll(false);
        $data['users'] = $this->userService->getAll();
        return view('dashboard.admin.user.index', $data);
    }

    public function create(Request $request)
    {
        try {

            if ($this->userService->create($request->all())) {
                return redirect()->back()->with(AlertMessage::success('Berhasil menambahkan user.'));
            }
            return redirect()->back()->with(AlertMessage::danger('Gagal menambahkan user.'));
        } catch (\Exception $e) {
            return redirect()->back()->with(AlertMessage::danger('Gagal menambahkan user. ' . $e->getMessage()));
        }
    }

    public function biodata(int $id)
    {
        $data['user'] = $this->userService->findById($id);
        return view('dashboard.admin.user.biodata', $data);
    }

    public function changePassword(Request $request, int $id)
    {
        $data = $request->validate([
            "password" => "required",
            "password_confirmation" => "required_with:password|same:password"
        ]);


        $user = $this->userService->findById($id);

        $user->password = $data['password'];
        if($user->save())
        {
            return redirect()->back()->with(AlertMessage::success('Berhasil mengubah password.'));
        }
        return redirect()->back()->with(AlertMessage::danger('Gagal mengubah password.'));
    }
}
