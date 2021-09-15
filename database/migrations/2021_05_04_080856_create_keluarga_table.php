<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKeluargaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('keluarga', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('password');
            $table->string('no_kk')->nullable()->unique();
            $table->string('kontak')->nullable();
            $table->string('alamat')->nullable();
            $table->string('photo_kartu_keluarga')->nullable();
            $table->unsignedBigInteger('rt')->nullable();
            $table->foreign('rt')->references('id')->on('rukun_tetangga')->onDelete('set null');
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
        Schema::dropIfExists('keluarga');
    }
}
