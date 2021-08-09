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
        $matakuliah = MataKuliah::where('nama', 'like', "%$search%")->get();
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
}
