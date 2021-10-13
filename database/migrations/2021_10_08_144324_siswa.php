<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Siswa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siswa', function (Blueprint $table) {
            $table->unsignedInteger('nis')->unique();
            $table->string('password');
            $table->string('nama');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->tinyInteger('kelas')->unsigned();
            $table->enum('jurusan', ['AK', 'RPL', 'TKJ']);
            $table->year('tahun');
            $table->integer('id_industri')->unsigned()->nullable();
            $table->foreign('id_industri')
                ->references('id')
                ->on('industri')
                ->onDelete('cascade');
            $table->rememberToken();
            $table->primary('nis');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('siswa');
    }
}
