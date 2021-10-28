<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\NilaiMahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $mahasiswa = Mahasiswa::with('user')->get()->take(10);
        // $nilai = DB::table('nilai_mahasiswa')
        //     ->join('mahasiswa', 'mahasiswa.id', '=', 'nilai_mahasiswa.mahasiswa_id')
        //     ->join('konsentrasi', 'konsentrasi.id', '=', 'mahasiswa.konsentrasi_id')
        //     ->selectRaw('nilai_mahasiswa.nilai, count(nilai_mahasiswa.id) as number_mhs, mahasiswa.nama as nama, konsentrasi.nama as konsentrasi')
        //     ->groupBy('nilai_mahasiswa.mahasiswa_id')
        //     ->having('nilai_mahasiswa.nilai', '>', 85)
        //     ->get();
        $nilai = DB::select("SELECT e.*, u.nim, (SELECT count(p.id) FROM nilai_mahasiswa AS p WHERE e.id = p.mahasiswa_id AND nilai::INT > 85 AND is_approve = 1) AS nilai_a FROM mahasiswa AS e INNER JOIN users AS u ON e.user_id = u.id  ORDER BY nilai_a DESC LIMIT 5");
        return view('home', compact('mahasiswa', 'nilai'));
    }

    public function profile($user)
    {
        $mahasiswa = Mahasiswa::with(['detail', 'user'])->where('user_id', $user->id)->firstOrFail();
        if (@$mahasiswa->detail->deskripsi)
            return view('profile', compact('mahasiswa'));
        else abort(404);
    }

    public function listProfile(Request $request)
    {
        if ($request->search) {
            $mahasiswa = Mahasiswa::with(['detail', 'konsentrasi', 'user'])->where('nama', 'ilike', "%$request->search%")->paginate(10);
        } else {
            $mahasiswa = Mahasiswa::with(['detail', 'konsentrasi', 'user'])->paginate(10);
        }
        return view('services', compact('mahasiswa'));
    }

    public function nilai($user)
    {
        $mhs = Mahasiswa::with('nilai')->where('user_id', $user->id)->firstOrFail();
        $nilai = $mhs->nilai()->where('is_approve', 1)->distinct()->orderBy('semester', 'asc')->get('semester');
        return view('nilai', compact('nilai', 'mhs'));
    }

    public function dev()
    {
        if (env("DATABASE_URL")) {
            dd("ok");
        } else {
            dd("K");
        }
    }
}
