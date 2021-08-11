<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\Snappy\Facades\SnappyPdf as PDF;
use Illuminate\Support\Facades\Storage;

class CVController extends Controller
{
    public function index()
    {
        $mahasiswa = Mahasiswa::where('user_id', Auth::user()->id)->first();
        return view('cv.index', compact('mahasiswa'));
    }

    public function post(Request $request)
    {
        $mahasiswa = Mahasiswa::where('user_id', Auth::user()->id)->first();
        $data = $request->all();
        // return view('cv.pdf', compact('data'));
        $fpdf = uniqid() . ".pdf";
        $pdf = PDF::loadView('cv.pdf', compact('data'));
        if ($mahasiswa->cv) Storage::disk('public')->delete('mahasiswa/cv/' . $mahasiswa->cv);
        $pdf->setPaper('a4')->save('storage/mahasiswa/cv/' . $fpdf);
        $mahasiswa->cv = $fpdf;
        $mahasiswa->save();

        return redirect()->route('mahasiswa.personal')->with(['success' => 'Berhasil Membuat CV']);
    }
}
