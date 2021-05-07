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
            'first_name' => 'required',
            'last_name' => 'required',
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
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
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
            'email' => 'email|required',
            'password' => 'required'
        ]);
        $user = User::where('email', $request->email)->first();
        $cre = [
            'email' => $request->email,
            'password' => $request->password
        ];
        if (Auth::attempt($cre)) {
            if ($user && $user->status == 0) {
                Auth::logout();
                return redirect()->route('login')->with('status', 'Email anda belum di verifikasi. Silahkan hubungi Admin');
            } else {
                return redirect()->route('home');
            }
        } else {
            return redirect()->route('login')->with('status', 'Email atau Password anda salah')->withInput();
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }
}
