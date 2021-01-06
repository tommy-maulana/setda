<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKalenderKerjasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kalender_kerja', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kegiatan',50);
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->bigInteger('id_jam');
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
        Schema::dropIfExists('kalender_kerjas');
    }
}
