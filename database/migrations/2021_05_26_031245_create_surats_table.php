<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuratsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surats', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_warga')->nullable();
            $table->unsignedBigInteger('id_keluarga')->nullable();
            $table->unsignedBigInteger('id_rt')->nullable();
            $table->unsignedBigInteger('id_rw')->nullable();
            $table->string('nomor_surat')->nullable();
            $table->string('keperluan')->nullable();
            $table->string('alamat_pemohon')->nullable();
            $table->string('alamat_rt')->nullable();
            $table->string('alamat_rw')->nullable();
            $table->string('nama_lengkap')->nullable();
            $table->string('nik')->nullable();
            $table->string('tempat')->nullable();
            $table->string('tanggal_lahir')->nullable();
            $table->string('pekerjaan')->nullable();
            $table->string('agama')->nullable();
            $table->string('status_perkawinan')->nullable();
            $table->string('keterangan')->nullable();//->for keterangan tambahan if needed
            $table->string('current_rt')->nullable();
            $table->string('current_rw')->nullable();
            $table->string('nama_rt')->nullable();
            $table->string('nama_rw')->nullable();
            $table->string('sekretariat')->nullable();
            $table->string('telepon')->nullable(); // Telepon RT
            $table->string('kodepos')->nullable(); // Kodepos RT
            $table->boolean('is_rt_approved')->nullable();
            $table->boolean('is_rw_approved')->nullable();
            $table->string('id_cap_rt')->nullable(); #path cap terdahulu, agar data surat lama tidak berubah 
            $table->string('id_cap_rw')->nullable(); #ibid
            $table->string('id_ttd_rt')->nullable(); #ibid
            $table->string('id_ttd_rw')->nullable(); 
            $table->boolean('status')->nullable(); #ibid
            $table->foreign('id_warga')->references('id')->on('rukun_warga')->onDelete('set null');
            $table->foreign('id_keluarga')->references('id')->on('keluarga')->onDelete('set null');
            $table->foreign('id_rt')->references('id')->on('rukun_tetangga')->onDelete('set null');
            $table->foreign('id_rw')->references('id')->on('rukun_warga')->onDelete('cascade');
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
        Schema::dropIfExists('surats');
    }
}
