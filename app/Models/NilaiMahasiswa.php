<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiMahasiswa extends Model
{
    use HasFactory;

    protected $table = 'nilai_mahasiswa';

    protected $guarded = ['id'];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }
    public function matakuliah()
    {
        return $this->belongsTo(MataKuliah::class);
    }
}
