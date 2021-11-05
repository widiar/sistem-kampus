<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use App\Models\Konsentrasi;
use App\Models\MataKuliah;
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
        $konsentrasi = Konsentrasi::with('jurusan')->orderBy('id', 'ASC')->get();
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
        // dd($request->all());
        $request->validate([
            'konsentrasi' => 'required',
            'jurusan' => 'required|exists:jurusan,id',
        ]);
        try {
            if ($request->topik) {
                $syarat = [];
                foreach (array_combine($request->matkul, $request->nilai) as $matkul => $nilai) {
                    $syarat[] = [
                        'id' => $matkul,
                        'nilai' => $nilai
                    ];
                }
                Konsentrasi::create([
                    'nama' => $request->konsentrasi,
                    'jurusan_id' => $request->jurusan,
                    'skill' => json_encode($request->skill),
                    'job' => json_encode($request->job),
                    'topik' => json_encode($request->topik),
                    'syarat' => json_encode($syarat),
                ]);
            } else {
                Konsentrasi::create([
                    'nama' => $request->konsentrasi,
                    'jurusan_id' => $request->jurusan
                ]);
            }
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
        $matakuliah = MataKuliah::all();
        return view('admin.konsentrasi.edit', compact('konsentrasi', 'jurusan', 'matakuliah'));
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
            $syarat = [];
            foreach (array_combine($request->matkul, $request->nilai) as $matkul => $nilai) {
                $syarat[] = [
                    'id' => $matkul,
                    'nilai' => strtoupper($nilai)
                ];
            }
            $konsentrasi->nama =  $request->konsentrasi;
            $konsentrasi->jurusan_id = $request->jurusan;
            $konsentrasi->skill = json_encode($request->skill);
            $konsentrasi->job = json_encode($request->job);
            $konsentrasi->topik = json_encode($request->topik);
            $konsentrasi->syarat = json_encode($syarat);
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
