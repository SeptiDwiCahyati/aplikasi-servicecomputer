<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class AddStatusToServisTable extends Migration
{
    public function up()
    {
        Schema::table('servis', function (Blueprint $table) {
            $table->boolean('status')->default(false);
        });
    }

    public function down()
    {
        Schema::table('servis', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
}