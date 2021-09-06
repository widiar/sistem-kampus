<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMahasiswasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mahasiswa', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->nullable();
            $table->string('gender')->nullable();
            $table->string('alamat')->nullable();
            $table->string('notlp')->nullable();
            $table->string('image')->nullable();
            $table->string('ttl')->nullable();
            $table->string('cv')->nullable();
            $table->integer('score')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('jurusan_id')->nullable();
            $table->unsignedBigInteger('konsentrasi_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('mahasiswa');
    }
}
