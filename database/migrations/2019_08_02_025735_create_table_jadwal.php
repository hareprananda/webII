<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableJadwal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jadwal', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('pemesan')->unsigned();
            $table->time('mulai');
            $table->time('selesai');
            $table->date('tanggal');
            $table->bigInteger('id_kelas')->unsigned();
            $table->enum('status',['pending','approve','complete','ignored'])->default('pending');
            $table->text('keperluan');
            $table->foreign('pemesan')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_kelas')->references('id')->on('kelas')->onDelete('cascade');
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
        Schema::dropIfExists('jadwal');
    }
}
