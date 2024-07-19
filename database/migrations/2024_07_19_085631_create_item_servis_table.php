<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemServisTable extends Migration
{
    public function up()
    {
        Schema::create('item_servis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('servis_id');
            $table->unsignedBigInteger('barang_id');
            $table->integer('jumlah');
            $table->foreign('servis_id')->references('servis_id')->on('servis')->onDelete('cascade');
            $table->foreign('barang_id')->references('id_barang')->on('barangs')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('item_servis');
    }
}