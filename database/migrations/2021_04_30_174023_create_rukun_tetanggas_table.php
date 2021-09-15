<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRukunTetanggasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rukun_tetangga', function (Blueprint $table) {
            $table->id();
            $table->string('kode');
            $table->string('nama')->nullable();
            $table->string('password');
            $table->string('kontak')->unique();
            $table->string('alamat')->nullable();
            $table->unique(['kode', 'id_rw']);
            $table->unsignedBigInteger('id_rw');
            $table->foreign('id_rw')->references('id')->on('rukun_warga')->onDelete('cascade');
            $table->string('status')->nullable();
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
        Schema::dropIfExists('rukun_tetangga');
    }
}
