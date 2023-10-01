<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        if (\Auth::attempt(['username' => $request->username, 'password' => $request->password, 'role'=>$request->role])) {
            if(\Auth::user()->role == 'admin')
            {
                return redirect('/admin/home.html');
            }
            return redirect('/dosen_plp/home.html');
        }
        return redirect()->back()->with('alert', [
            'type' => 'danger',
            'message' => 'Username atau password salah!'
        ]);
    }
}
