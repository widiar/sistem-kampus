<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use App\Models\Konsentrasi;
use Illuminate\Http\Request;

class KonsentrasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $konsentrasi = Konsentrasi::with('jurusan')->get();
        return view('admin.konsentrasi.index', compact('konsentrasi'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jurusan = Jurusan::all();
        return view('admin.konsentrasi.create', compact('jurusan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'konsentrasi' => 'required',
            'jurusan' => 'required|exists:jurusan,id'
        ]);
        try {
            Konsentrasi::create([
                'nama' => $request->konsentrasi,
                'jurusan_id' => $request->jurusan
            ]);
            return redirect()->route('admin.konsentrasi.index')->with(['success' => 'Berhasil Menambah Data']);
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Konsentrasi $konsentrasi)
    {
        $jurusan = Jurusan::all();
        return view('admin.konsentrasi.edit', compact('konsentrasi', 'jurusan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Konsentrasi $konsentrasi)
    {
        $request->validate([
            'konsentrasi' => 'required',
            'jurusan' => 'required|exists:jurusan,id'
        ]);
        try {
            $konsentrasi->nama =  $request->konsentrasi;
            $konsentrasi->jurusan_id = $request->jurusan;
            $konsentrasi->save();
            return redirect()->route('admin.konsentrasi.index')->with(['success' => 'Berhasil Update Data']);
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Konsentrasi $konsentrasi)
    {
        try {
            $konsentrasi->matakuliah()->delete();
            $konsentrasi->delete();
            return "Sukses";
        } catch (\Throwable $th) {
            return $th;
        }
    }
}
