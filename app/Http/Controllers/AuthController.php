<?php

namespace App\Http\Controllers;

use App\Mail\ResetPassword;
use App\Models\PasswordReset;
use App\Models\User;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
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
            'nama' => 'required',
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
        $user = User::create($data);
        if ($user) {
            $user->mahasiswa()->create([
                'nama' => $request->nama
            ]);
            return redirect()->route('register')->with('status', 'Anda berhasil mendaftar');
        }
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

    public function forgot(Request $request)
    {
        $request->validate([
            'email' => 'email|required'
        ]);
        $user = User::where('email', $request->email)->first();
        if ($user) {
            if ($user->status == 0 && $user->role != 1) {
                return redirect()->route('login')->with('status', 'Akun anda belum di verifikasi. Silahkan hubungi Admin');
            } else {
                PasswordReset::where('email', $request->email)->delete();
                $tok = base64_encode(random_bytes(17));
                PasswordReset::insert([
                    'email' => $request->email,
                    'token' => $tok,
                    'created_at' => Carbon::now()
                ]);
                Mail::to($request->email)->send(new ResetPassword($request->email, $tok));
                return redirect()->route('forgotpw')->with('statussukses', 'Silahkan Cek Email Anda.');
            }
        } else {
            return redirect()->route('forgotpw')->with('warning', 'Email ini tidak terdaftar')->withInput();
        }
    }

    public function reset(Request $request)
    {
        $email = $request->email;
        $token = urldecode($request->token);

        $user = PasswordReset::where('email', $email)->firstOrFail();
        $expire = new DateTime($user->created_at);
        $expire->modify('+1 hour');
        if (new DateTime() < $expire) {
            if (strcmp($token, $user->token) == 0) {
                return view('auth.resetpw');
            }
        }
        return redirect()->route('login')->with('status', 'Link Expired');
    }

    public function postReset(Request $request)
    {
        $email = $request->email;
        $token = $request->token;
        $rules = [
            'password' => 'required|min:8',
            'confirmPassword' => 'required|same:password|min:8',
        ];
        $messages = [
            'required' => 'Tolong :attribute di isi',
            'confirmPassword.same' => 'Password haruslah sama',
            'min' => ':Attribute haruslah minimal :min karakter',
        ];
        $valid = Validator::make($request->all(), $rules, $messages);
        if ($valid->fails()) {
            return redirect()->route('resetPass', ['email' => $email, 'token' => $token])->withErrors($valid)->withInput();
        }
        $user = User::where('email', $email)->first();
        if (Hash::check($request->password, $user->password)) return redirect()->route('resetPass', ['email' => $email, 'token' => $token])->with('status', 'Password anda sama dengan sebelumnya, silahkan gunakan password yang lain');
        $user->password = Hash::make($request->password);
        $user->save();
        PasswordReset::where('email', $email)->delete();
        return redirect()->route('login')->with('statussukses', 'Password berhasil diubah silahkan login');
    }
}
