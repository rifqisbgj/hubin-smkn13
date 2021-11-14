<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiswaLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:siswa', ['except' => 'logout']);
    }

    public function index()
    {
        return view('home');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('nis', 'password');

        $this->validate($request, [
            'nis' => 'required|integer',
            'password' => 'required',
        ]);

        if (Auth::guard('siswa')->attempt($credentials, $request->remember)) {
            return redirect()->intended(route('siswa.home'));
        }

        return redirect()->back()->withInput($credentials);
    }

    public function logout()
    {
        Auth::guard('siswa')->logout();

        return redirect('/');
    }
}
