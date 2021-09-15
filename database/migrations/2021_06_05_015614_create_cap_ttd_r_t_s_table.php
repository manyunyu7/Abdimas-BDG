<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCapTtdRTSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cap_ttd_r_t_s', function (Blueprint $table) {
            $table->id();
            $table->string('path');
            $table->string('type');  // 1 for ttd, 2 for cap RT
            $table->unsignedBigInteger('rt')->nullable();
            $table->foreign('rt')->references('id')->on('rukun_tetangga')->onDelete('set null');
            $table->string('is_deleted')->nullable();
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
        Schema::dropIfExists('cap_ttd_r_t_s');
    }
}
