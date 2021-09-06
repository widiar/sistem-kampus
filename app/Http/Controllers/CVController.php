<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\Snappy\Facades\SnappyPdf as PDF;
use Illuminate\Support\Facades\Storage;
use ImageKit\ImageKit;

class CVController extends Controller
{
    public function index()
    {
        $mahasiswa = Mahasiswa::where('user_id', Auth::user()->id)->first();
        if (!$mahasiswa->nama) return redirect()->route('mahasiswa.alumni')->with(['info' => 'Silahkan Update Data di Personal dahulu']);
        return view('cv.index', compact('mahasiswa'));
    }

    public function post(Request $request)
    {
        $mahasiswa = Mahasiswa::where('user_id', Auth::user()->id)->first();
        $data = $request->all();
        // return view('cv.pdf', compact('data'));
        $fpdf = uniqid() . ".pdf";
        $pdf = PDF::loadView('cv.pdf', compact('data'));
        if (env('APP_HOST') == 'heroku') {
            $imageKit = new ImageKit(
                env('IMAGE_KIT_PUBLIC_KEY'),
                env('IMAGE_KIT_SECRET_KEY'),
                env('IMAGE_KIT_ENDPOINT')
            );
        }
        if ($mahasiswa->cv) {
            if (env('APP_HOST') == 'heroku') {
                $imageKit->deleteFile(json_decode($mahasiswa->cv)->field);
            } else {
                Storage::disk('public')->delete('mahasiswa/cv/' . $mahasiswa->cv);
            }
        }
        if (env('APP_HOST') == 'heroku') {
            $path = base_path('public/uploads/files/');
            $pdf->setPaper('a4')->save($path . $fpdf);
            $uploadFile = $imageKit->upload([
                'file' => fopen($path . $fpdf, "r"),
                'fileName' => $fpdf,
                'folder' => "sistem-kampus//mahasiswa//cv//"
            ]);
            $mahasiswa->cv = json_encode([
                "field" => $uploadFile->success->fileId,
                "url" => $uploadFile->success->url,
            ]);
        } else {
            $pdf->setPaper('a4')->save('storage/mahasiswa/cv/' . $fpdf);
            $mahasiswa->cv = $fpdf;
        }
        $mahasiswa->save();

        return redirect()->route('mahasiswa.personal')->with(['success' => 'Berhasil Membuat CV']);
    }
}
