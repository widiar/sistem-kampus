<?php

namespace App\Http\Controllers;

use App\Http\Requests\MahasiswaRequest;
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
        return view('mahasiswa.personal', compact('user'));
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
}
