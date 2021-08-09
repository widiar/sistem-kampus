<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNilaiMahasiswasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nilai_mahasiswa', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mahasiswa_id');
            $table->unsignedBigInteger('matakuliah_id');
            $table->string('semester');
            $table->string('nilai');
            $table->timestamps();

            $table->foreign('mahasiswa_id', 'mahasiswa_fk_11')->references('id')->on('mahasiswa')->onDelete('cascade');
            $table->foreign('matakuliah_id', 'matakuliah_fk_11')->references('id')->on('mata_kuliah')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nilai_mahasiswa');
    }
}
