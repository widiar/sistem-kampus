<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequirmentColumnToKonsentrasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('konsentrasi', function (Blueprint $table) {
            $table->text('skill')->nullable();
            $table->text('topik')->nullable();
            $table->text('job')->nullable();
            $table->text('syarat')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('konsentrasi', function (Blueprint $table) {
            $table->dropColumn(['skill', 'topik', 'job', 'syarat']);
        });
    }
}
