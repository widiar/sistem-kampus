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
use App\Models\Konsentrasi;
use App\Models\QuestionCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use ImageKit\ImageKit;

class MahasiswaController extends Controller
{

    public function quiz()
    {
        $us = Auth::user();
        if (isset($us->mahasiswa)) return redirect()->route('mahasiswa.personal');
        $category = QuestionCategory::all();
        $data = [];
        foreach ($category as $key) {
            $dt = Questions::with('options')->where('category_id', $key->id)->inRandomOrder()->limit(3)->get();
            array_push($data, $dt);
        }
        // $questions = Questions::inRandomOrder()->limit(3)->get();
        return view('mahasiswa.quiz', compact('data'));
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
        $konsentrasi = Konsentrasi::where('jurusan_id', @$user->mahasiswa->jurusan->id)->get();
        // dd($konsentrasi);
        return view('mahasiswa.personal', compact('user', 'jurusan', 'konsentrasi'));
    }

    public function getKonsentrasi($id)
    {
        try {
            $konsentrasi = Konsentrasi::where('jurusan_id', $id)->get();
            return response()->json([
                'result' => 200,
                'data' => $konsentrasi
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'result' => 201
            ]);
        }
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
            $user->mahasiswa->konsentrasi_id = $request->konsentrasi;
            $user->mahasiswa->ttl = $request->ttl;
            if ($request->image) {
                $image = $request->image;
                // dd($image->getPathname());
                if (env('APP_HOST') == 'heroku') {
                    $imageKit = new ImageKit(
                        env('IMAGE_KIT_PUBLIC_KEY'),
                        env('IMAGE_KIT_SECRET_KEY'),
                        env('IMAGE_KIT_ENDPOINT')
                    );
                    $uploadFile = $imageKit->upload([
                        'file' => fopen($image->getPathname(), "r"),
                        'fileName' => $image->hashName(),
                        'folder' => "sistem-kampus//mahasiswa//image//"
                    ]);
                    $user->mahasiswa->image = json_encode([
                        "field" => $uploadFile->success->fileId,
                        "url" => $uploadFile->success->url,
                    ]);
                } else {
                    $user->mahasiswa->image = $image->hashName();
                    if ($user->mahasiswa->image) Storage::disk('public')->delete('mahasiswa/image/' . $user->mahasiswa->image);
                    $image->storeAs('public/mahasiswa/image', $image->hashName());
                }
            }
            $user->mahasiswa->save();
        }

        return redirect()->route('mahasiswa.personal')->with(['success' => 'Berhasil Update Data']);
    }

    public function nilai()
    {
        $user = Auth::user();
        if (!$user->mahasiswa->gender) return redirect()->route('mahasiswa.personal')->with(['info' => 'Silahkan Update Data di Personal dahulu']);
        $nilai = NilaiMahasiswa::select('semester', 'is_approve')->where('mahasiswa_id', $user->mahasiswa->id)->distinct()->orderBy('semester')->get();
        return view('mahasiswa.nilai', compact('nilai'));
    }

    public function addNilai()
    {
        $user = Auth::user();
        if (!$user->mahasiswa->gender) return redirect()->route('mahasiswa.personal')->with(['info' => 'Silahkan Update Data di Personal dahulu']);
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
        $smtMhs = $mahasiswa->nilai()->select('semester')->distinct()->get();
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
        if ($nilai->count() < 1) abort(404);
        $matakuliah = MataKuliah::all();
        return view('mahasiswa.editNilai', compact('nilai', 'matakuliah'));
    }

    public function deleteNilai($smt)
    {
        $mahasiswa = Mahasiswa::where('user_id', Auth::user()->id)->first();
        $delete = $mahasiswa->nilai()->where('semester', $smt)->delete();
        $nilai = NilaiMahasiswa::select('semester', 'is_approve')->where('mahasiswa_id', $mahasiswa->id)->distinct()->orderBy('semester')->get();
        return view('mahasiswa.showNilai', compact('nilai'));
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

    public function alumni()
    {
        $mahasiswa = Mahasiswa::where('user_id', Auth::user()->id)->first();
        return view('mahasiswa.alumni', compact('mahasiswa'));
    }

    public function storeAlumni(Request $request)
    {
        $mahasiswa = Mahasiswa::where('user_id', Auth::user()->id)->first();
        $request->validate([
            'cv' => 'file|mimes:pdf'
        ]);
        $cv = $request->cv;
        if (env('APP_HOST') == 'heroku') {
            $imageKit = new ImageKit(
                env('IMAGE_KIT_PUBLIC_KEY'),
                env('IMAGE_KIT_SECRET_KEY'),
                env('IMAGE_KIT_ENDPOINT')
            );
            if ($mahasiswa->cv) $imageKit->deleteFile(json_decode($mahasiswa->cv)->field);
            $uploadFile = $imageKit->upload([
                'file' => fopen($cv->getPathname(), "r"),
                'fileName' => $cv->hashName(),
                'folder' => "sistem-kampus//mahasiswa//cv//"
            ]);
            $mahasiswa->cv = json_encode([
                "field" => $uploadFile->success->fileId,
                "url" => $uploadFile->success->url,
            ]);
        } else {
            $mahasiswa->cv = $cv->hashName();
            if ($mahasiswa->cv) Storage::disk('public')->delete('mahasiswa/cv/' . $mahasiswa->cv);
            $cv->storeAs('public/mahasiswa/cv', $cv->hashName());
        }
        $mahasiswa->save();
        return redirect()->route('mahasiswa.alumni')->with(['success' => 'Berhasil! Data di simpan.']);
    }
}
