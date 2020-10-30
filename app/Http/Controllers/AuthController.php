<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;


class AuthController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function login_post(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            notify()->success('Tekrardan Hosgeldiniz ' . Auth::user()->name);
            return redirect()->route('tasks');
        } else {
            return redirect()->route('login')->withErrors('E-Posta veya sifre hatalidir');
        }
    }

    public function register()
    {
        return view('register');
    }

    public function register_post(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|unique:admins|email',
            'password' => 'required|min:6',
        ]);

        $admin = new Admin;
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->password = bcrypt($request->password);

        $admin->save();
        notify()->success('Basarili', 'Kullanıcı basariyla olusturuldu.');
        return redirect()->route('tasks');
    }

    public function logout()
    {
        Auth::logout();
        notify()->success('Cikis Basarili.');
        return redirect()->route('home');
    }


}
