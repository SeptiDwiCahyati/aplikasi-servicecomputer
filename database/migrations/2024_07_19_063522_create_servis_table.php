<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServisTable extends Migration
{
    public function up()
    {
        Schema::create('servis', function (Blueprint $table) {
            $table->id('servis_id');
            $table->unsignedInteger('keluhan_id');
            $table->unsignedBigInteger('pegawai_id');
            $table->unsignedBigInteger('barang_id');
            $table->date('tanggal_servis');
            $table->text('deskripsi_servis');
            $table->foreign('keluhan_id')->references('id_keluhan')->on('keluhan')->onDelete('cascade');
            $table->foreign('pegawai_id')->references('id_pegawai')->on('pegawai')->onDelete('cascade');
            $table->foreign('barang_id')->references('id_barang')->on('barang')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('servis');
    }
}
