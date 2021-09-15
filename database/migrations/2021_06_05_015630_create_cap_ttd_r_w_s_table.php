<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCapTtdRWSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cap_ttd_r_w_s', function (Blueprint $table) {
            $table->id();
            $table->string('path');
            $table->string('type');  // 1 for ttd, 2 for cap RW
            $table->unsignedBigInteger('rw')->nullable();
            $table->foreign('rw')->references('id')->on('rukun_warga')->onDelete('set null');
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
        Schema::dropIfExists('cap_ttd_r_w_s');
    }
}
