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
            $table->increments('id');
            $table->string('nama');
            $table->year('tahun');
            $table->text('alamat');
            $table->tinyInteger('kuota')->unsigned();
            $table->string('pembimbing');
            $table->string('nip_pembimbing');
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
