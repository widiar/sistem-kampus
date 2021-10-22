<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\MataKuliah;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function matkul(Request $request)
    {
        $search = $request->search;
        $matakuliah = MataKuliah::where('nama', 'ilike', "%$search%")->get();
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
