<?php

namespace App\Http\Controllers;

use App\Http\Requests\MataKuliahRequest;
use App\Models\Jurusan;
use App\Models\Konsentrasi;
use App\Models\MataKuliah;
use Illuminate\Http\Request;

class MataKuliahController extends Controller
{
    public function index()
    {
        $matakuliah = MataKuliah::all();
        return view('admin.matakuliah.index', compact('matakuliah'));
    }

    public function create()
    {
        $jurusan = Konsentrasi::all();
        return view('admin.matakuliah.create', compact('jurusan'));
    }

    public function store(MataKuliahRequest $request)
    {
        MataKuliah::create([
            'kode' => $request->kode,
            'nama' => $request->nama,
            'sks' => $request->sks,
            'konsentrasi_id' => $request->jurusan,
        ]);
        return redirect()->route('admin.matakuliah.index')->with(['success' => 'Berhasil Menambah Mata Kuliah']);
    }

    public function edit(MataKuliah $matakuliah)
    {
        $jurusan = Konsentrasi::all();
        return view('admin.matakuliah.edit', compact('matakuliah', 'jurusan'));
    }

    public function update(MataKuliah $matakuliah, MataKuliahRequest $request)
    {
        $matakuliah->kode = $request->kode;
        $matakuliah->nama = $request->nama;
        $matakuliah->sks = $request->sks;
        $matakuliah->konsentrasi_id = $request->jurusan;
        $matakuliah->save();
        return redirect()->route('admin.matakuliah.index')->with(['success' => 'Berhasil Update Mata Kuliah']);
    }

    public function delete($id)
    {
        $matkul = MataKuliah::find($id);
        $matkul->delete();
        return "Sukses";
    }
}
