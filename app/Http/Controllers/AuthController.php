<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register()
    {
        if (Auth::check()) return redirect()->route('home');
        return view('auth.register');
    }
    public function doRegister(Request $request)
    {
        $rules = [
            'nim' => 'required|unique:users|digits:9',
            'password' => 'required|same:password2|min:8',
            'email' => 'email|required|unique:users',
        ];
        $messages = [
            'required' => 'Tolong :attribute di isi',
            'password.same' => 'Password haruslah sama',
            'min' => ':Attribute haruslah minimal :min karakter',
        ];
        $valid = Validator::make($request->all(), $rules, $messages);
        if ($valid->fails()) {
            return redirect()->route('register')->withErrors($valid)->withInput();
        }

        $password = Hash::make($request->password);
        $data = [
            'nim' => $request->nim,
            'email' => $request->email,
            'password' => $password,
        ];
        if (User::create($data))
            return redirect()->route('register')->with('status', 'Anda berhasil mendaftar');
    }

    public function login()
    {
        if (Auth::check()) return redirect()->route('home');
        return view('auth.login');
    }

    public function doLogin(Request  $request)
    {
        $request->validate([
            'nim' => 'required',
            'password' => 'required'
        ]);
        $user = User::where('nim', $request->nim)->first();
        $cre = [
            'nim' => $request->nim,
            'password' => $request->password
        ];
        if (Auth::attempt($cre)) {
            if ($user && $user->status == 0 && $user->role != 1) {
                Auth::logout();
                return redirect()->route('login')->with('status', 'Akun anda belum di verifikasi. Silahkan hubungi Admin');
            } else if ($user && $user->role == 1) {
                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->route('home');
            }
        } else {
            return redirect()->route('login')->with('status', 'Nim atau Password anda salah')->withInput();
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }
}
