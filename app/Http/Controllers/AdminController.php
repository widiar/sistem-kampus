<?php

namespace App\Http\Controllers;

use App\Mail\ConfirmMail;
use App\Models\Mahasiswa;
use App\Models\NilaiMahasiswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    public function mahasiswa(Request $request)
    {
        $mahasiswa = User::with('mahasiswa')->where('role', 0)->get();
        return view('admin.mahasiswa', compact('mahasiswa'));
    }

    public function verifikasi(User $user, $status)
    {
        $user->status = $status;
        Mail::to($user->email)->send(new ConfirmMail());
        $user->save();
        return "Sukses";
    }

    public function nilaiMahasiswa()
    {
        $mahasiswa = Mahasiswa::where('nama', '<>', null)->get();
        return view('admin.nilai.index', compact('mahasiswa'));
    }

    public function verifNilai(Mahasiswa $mhs)
    {
        $nilai = $mhs->nilai()->distinct()->orderBy('semester', 'asc')->get('semester');
        // dd($nilai);
        return view('admin.nilai.verif', compact('nilai', 'mhs'));
    }

    public function getNilai(Request $request)
    {
        $mhs = Mahasiswa::find($request->id);
        $nilai = $mhs->nilai()->where('semester', $request->semester)->get();
        foreach ($nilai as $val) {
            $data[] = [
                'matkul' => $val->matakuliah->nama,
                'nilai' => $val->nilai
            ];
        }
        $status = $nilai[0]->is_approve;
        if ($status == 0) {
            $class = 'badge-warning';
            $text = 'Pending';
        } else if ($status == 1) {
            $class = 'badge-success';
            $text = 'Approved';
        } else {
            $class = 'badge-danger';
            $text = 'Rejected';
        }
        return response()->json([
            'status' => $text,
            'class' => $class,
            'data' => $data
        ]);
    }

    public function updateNilai(Request $request)
    {
        try {
            NilaiMahasiswa::where('mahasiswa_id', $request->id)->where('semester', $request->semester)->update(['is_approve' => $request->status]);
            return response()->json("Sukses");
        } catch (\Throwable $th) {
            return response()->json($th);
        }
    }
}
