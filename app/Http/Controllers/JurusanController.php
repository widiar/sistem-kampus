<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use Illuminate\Http\Request;

class JurusanController extends Controller
{
    public function index()
    {
        $jurusan = Jurusan::all();
        return view('admin.jurusan.index', compact('jurusan'));
    }

    public function create()
    {
        return view('admin.jurusan.create');
    }

    public function store(Request $request)
    {
        $request->validate(['jurusan' => 'required']);

        Jurusan::create([
            'nama' => $request->jurusan
        ]);

        return redirect()->route('admin.jurusan.index')->with(['success' => 'Berhasil menambah data']);
    }

    public function edit(Jurusan $jurusan)
    {
        return view('admin.jurusan.edit', compact('jurusan'));
    }

    public function update(Jurusan $jurusan, Request $request)
    {
        $request->validate(['jurusan' => 'required']);
        $jurusan->nama = $request->jurusan;
        $jurusan->save();
        return redirect()->route('admin.jurusan.index')->with(['success' => 'Berhasil update data']);
    }

    public function delete($id)
    {
        $jurusan = Jurusan::find($id);
        foreach ($jurusan->konsentrasi as $dt) {
            $dt->matakuliah()->delete();
        }
        $jurusan->konsentrasi()->delete();
        $jurusan->delete();
        return "Sukses";
    }
}
