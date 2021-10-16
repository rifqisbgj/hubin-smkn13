<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Admin;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        return view('admin.home');
    }

    public function pengaturan()
    {
        return view('admin.pengaturan');
    }

    public function pengaturanSubmit(Request $request)
    {
        $credentials = $request->only('username', 'password');

        $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
            'password_old' => 'password:admin',
        ]);

        $affected = Admin::where('username', Auth::user()->username)
            ->update([
                'username' => $request->username,
                'password' => Hash::make($request->password),
            ]);

        if ($affected) {
            Auth::guard('admin')->logout();
            Auth::guard('admin')->attempt($credentials, $request->remember);

            return redirect()->back()->with('status', true);
        }

        return redirect()->back()->withInput($credentials);
    }
}
