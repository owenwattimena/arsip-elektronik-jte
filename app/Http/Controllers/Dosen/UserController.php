<?php

namespace App\Http\Controllers\Dosen;

use App\Helpers\AlertMessage;
use App\Http\Controllers\Controller;
use App\Services\ProgramStudiService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
        return view('dashboard.dosen-plp.profil.index');
    }

    public function update(Request $request)
    {
        $request->validate(
            [
                'nama_lengkap' => 'required',
                'jenis_kelamin' => 'required',
                'tempat_lahir' => 'required',
                'tanggal_lahir' => 'required',
                'agama' => 'required',
                'alamat' => 'required',
                'telepon' => 'required',
                'email' => 'required',
            ]
        );
        try{

            if($this->userService->updateDosenPlp($request->all()))
            {
                return redirect()->back()->with(AlertMessage::success('Berhasil mengubah profil'));
            }
            return redirect()->back()->with(AlertMessage::danger('Gagal mengubah profil'));
        }catch(\Exception $e)
        {
            return redirect()->back()->with(AlertMessage::danger('Gagal mengubah profil. ' . $e->getMessage()));
        }
    }

    public function changePassword(Request $request)
    {
        $request->validate(
            [
                'password_lama' => 'required',
                'password' => 'required',
                'password_confirmation' => 'required_with:password|same:password',
            ]
        );

        if(!Hash::check($request->password_lama, \Auth::user()->password))
        {
            return redirect()->back()->withErrors(['password_lama'=>'Password lama salah']);
        }

        if($this->userService->changePassword($request->input()))
        {
            return redirect()->back()->with(AlertMessage::success('Berhasil mengubah kata sandi'));
        }
        return redirect()->back()->with(AlertMessage::danger('Gagal mengubah kata sandi'));
    }
}
