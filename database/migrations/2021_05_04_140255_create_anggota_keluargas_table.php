<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnggotaKeluargasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anggota_keluarga', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_keluarga');
            $table->foreign('id_keluarga')->references('id')->on('keluarga')->onDelete('cascade');
            $table->string("nik")->unique();
            $table->string("nama");
            $table->string("gender");
            $table->string("tempat_lahir")->nullable();
            $table->date("tanggal_lahir")->nullable();
            $table->string("agama")->nullable();
            $table->string("status_perkawinan")->nullable();
            $table->string("pendidikan")->nullable();
            $table->string("pekerjaan")->nullable();
            $table->string("current_address")->nullable();
            $table->string("path_ktp")->nullable();
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
        Schema::dropIfExists('anggota_keluarga');
    }
}
