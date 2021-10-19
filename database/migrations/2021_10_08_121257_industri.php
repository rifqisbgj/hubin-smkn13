<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Industri extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('industri', function (Blueprint $table) {
            $table->increments('id')->index();
            $table->string('nama')->unique();
            $table->string('bidang')->nullable();
            $table->string('kontak')->nullable();
            $table->set('jurusan', ['AK', 'RPL', 'TKJ']);
            $table->year('tahun');
            $table->text('alamat');
            $table->tinyInteger('kuota')->unsigned();
            $table->text('catatan')->nullable();

            /* Pengajuan */
            /* TODO: Foreign key nis siswa? */
            $table->unsignedInteger('nis_pengaju')->nullable();
            $table->boolean('status')->default(true);

            /* Data Pembimbing */
            $table->string('nama_pembimbing')->nullable();
            $table->unsignedBigInteger('nip_pembimbing')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('industri');
    }
}
