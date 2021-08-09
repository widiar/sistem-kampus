<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsApproveToNilaiMahasiswaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('nilai_mahasiswa', function (Blueprint $table) {
            $table->smallInteger('is_approve')->default(0)->after('nilai');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('nilai_mahasiswa', function (Blueprint $table) {
            $table->dropColumn('is_approve');
        });
    }
}
