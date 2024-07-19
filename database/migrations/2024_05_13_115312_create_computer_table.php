<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('computers', function (Blueprint $table) {
            $table->string('id_komputer', 10)->primary();
            $table->enum('merek', ['asus', 'acer', 'dell', 'lain']);
            $table->text('kelengkapan');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('computers');
    }
};
