<?php

namespace App\Http\Controllers;

use App\Http\Requests\MahasiswaRequest;
use App\Models\Jurusan;
use App\Models\Mahasiswa;
use App\Models\MataKuliah;
use App\Models\NilaiMahasiswa;
use App\Models\Options;
use App\Models\Questions;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MahasiswaController extends Controller
{

    public function quiz()
    {
        $us = Auth::user();
        if (isset($us->mahasiswa)) return redirect()->route('mahasiswa.personal');
        $questions = Questions::inRandomOrder()->get();
        return view('mahasiswa.quiz', compact('questions'));
    }

    public function storeQuiz(Request $request)
    {
        $us = Auth::user();
        $user = User::find($us->id);
        $answers = Options::find(array_values($request->answer));
        $score = 0;
        foreach ($answers as $answer) {
            if ($answer->is_true) $score += $answer->question->score;
        }
        $user->mahasiswa()->create([
            'score' => $score
        ]);
        return redirect()->route('mahasiswa.personal')->with(['info' => 'Silahkan Update Data Mahasiswa']);
    }

    public function personal()
    {
        $user = Auth::user();
        $jurusan = Jurusan::all();
        return view('mahasiswa.personal', compact('user', 'jurusan'));
    }

    public function store(MahasiswaRequest $request)
    {
        $us = Auth::user();
        $user = User::find($us->id);
        if (isset($user->mahasiswa)) {
            $user->mahasiswa->nama = $request->nama;
            $user->mahasiswa->gender = $request->gender;
            $user->mahasiswa->alamat = $request->alamat;
            $user->mahasiswa->notlp = $request->notlp;
            $user->mahasiswa->jurusan_id = $request->jurusan;
            $user->mahasiswa->save();
        } else {
            $user->mahasiswa()->create([
                'nama' => $request->nama,
                'gender' => $request->gender,
                'alamat' => $request->alamat,
                'notlp' => $request->notlp,
            ]);
        }

        return redirect()->route('mahasiswa.personal')->with(['success' => 'Berhasil Update Data']);
    }

    public function nilai()
    {
        $user = Auth::user();
        $nilai = NilaiMahasiswa::where('mahasiswa_id', $user->mahasiswa->id)->groupBy('semester')->get();
        return view('mahasiswa.nilai', compact('nilai'));
    }

    public function addNilai()
    {
        $matakuliah = MataKuliah::all();
        $semester = $this->getSemester();
        return view('mahasiswa.addNilai', compact('matakuliah', 'semester'));
    }

    public function storeNilai(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $data = [];
        foreach (array_combine($request->matkul, $request->nilai) as $matkul => $nilai) {
            $dt = [
                'matakuliah_id' => $matkul,
                'semester' => $request->semester,
                'nilai' => $nilai
            ];
            array_push($data, $dt);
        }
        $user->mahasiswa->nilai()->createMany($data);

        return redirect()->route('mahasiswa.nilai')->with(['success' => 'Berhasil! Nilai akan di verifikasi.']);
    }

    public function getSemester()
    {
        $mahasiswa = Mahasiswa::where('user_id', Auth::user()->id)->first();
        $smt = [1, 2, 3, 4, 5, 6, 7, 8];
        $smtMhs = $mahasiswa->nilai()->groupBy('semester')->get();
        foreach ($smtMhs as $sm) {
            if (($key = array_search($sm->semester, $smt)) !== false)
                unset($smt[$key]);
        }
        foreach ($smt as $data) {
            $semester[] = (object) [
                'id' => $data,
                'text' => "Semester $data"
            ];
        }
        return $semester;
    }

    public function show($smt)
    {
        $mahasiswa = Mahasiswa::where('user_id', Auth::user()->id)->first();
        $nilai = $mahasiswa->nilai()->where('semester', $smt)->get();
        return view('mahasiswa.showNilai', compact('nilai'));
    }

    public function editNilai($smt)
    {
        $mahasiswa = Mahasiswa::where('user_id', Auth::user()->id)->first();
        $nilai = $mahasiswa->nilai()->where('semester', $smt)->get();
        $matakuliah = MataKuliah::all();
        return view('mahasiswa.editNilai', compact('nilai', 'matakuliah'));
    }

    public function updateNilai(Request $request, $smt)
    {
        $mahasiswa = Mahasiswa::where('user_id', Auth::user()->id)->first();
        $nilai = $mahasiswa->nilai()->where('semester', $smt)->get();

        //delete
        foreach ($nilai as $vl) $nl[$vl->id] = 'tmp';
        foreach (array_diff_key($nl, $request->matkul) as $key => $nil) $nilai->find($key)->delete();

        //update insert
        $postNilai = $request->nilai;
        foreach ($request->matkul as $key => $value) {
            $cek = $nilai->find($key);
            $post = [
                'matakuliah_id' => $value,
                'nilai' => $postNilai[$key],
                'is_approve' => 0,
            ];
            if ($cek) $cek->update($post);
            else $mahasiswa->nilai()->create([
                'matakuliah_id' => $value,
                'nilai' => $postNilai[$key],
                'is_approve' => 0,
                'semester' => $smt
            ]);
        }

        return redirect()->route('mahasiswa.nilai')->with(['success' => 'Berhasil! Nilai akan di verifikasi kembali.']);
    }
}
