<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function mahasiswa(Request $request)
    {
        $mahasiswa = User::where('role', 0)->get();
        return view('admin.mahasiswa', compact('mahasiswa'));
    }

    public function verifikasi(User $user, $status)
    {
        $user->status = $status;
        $user->save();
        return "Sukses";
    }
}
