<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\MataKuliah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiController extends Controller
{
    public function matkul(Request $request)
    {
        $search = $request->search;
        if ($request->user_id) {
            $id = $request->user_id;
            $mahasiswa = Mahasiswa::with('nilai')->where('user_id', $id)->first();
            if (!$mahasiswa) return abort(403);
            $nilaiMhs = $mahasiswa->nilai()->get('matakuliah_id');
            $nilai = [];
            foreach ($nilaiMhs as $n) {
                array_push($nilai, $n->matakuliah_id);
            }
            if (env('DB_CONNECTION') == 'mysql') $matakuliah = MataKuliah::whereNotIn('id', $nilai)->where('nama', 'like', "%$search%")->get();
            else $matakuliah = MataKuliah::whereNotIn('id', $nilai)->where('nama', 'ilike', "%$search%")->get();
        } else {
            if (env('DB_CONNECTION') == 'mysql') $matakuliah = MataKuliah::where('nama', 'like', "%$search%")->get();
            else $matakuliah = MataKuliah::where('nama', 'ilike', "%$search%")->get();
        }
        $data = [];
        foreach ($matakuliah as $matkul) {
            $dt = [
                'id' => $matkul->id,
                'text' => $matkul->nama
            ];
            array_push($data, $dt);
        }
        return $data;
    }

    public function nilai(Request $request)
    {
        $mhs = Mahasiswa::with('nilai')->find($request->id);
        $nilai = $mhs->nilai()->where('semester', $request->semester)->where('is_approve', 1)->get();
        $data = [];
        foreach ($nilai as $val) {
            $data[] = [
                'matkul' => $val->matakuliah->nama,
                'nilai' => $val->nilai
            ];
        }
        return $data;
    }
}
