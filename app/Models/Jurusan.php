<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    use HasFactory;

    protected $table = 'jurusan';

    protected $guarded = ['id'];

    public function mahasiswa()
    {
        return $this->hasMany(Mahasiswa::class);
    }

    public function konsentrasi()
    {
        return $this->hasMany(Konsentrasi::class);
    }

    public function matakuliah()
    {
        return $this->hasMany(MataKuliah::class);
    }
}
