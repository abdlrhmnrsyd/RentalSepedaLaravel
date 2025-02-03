<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('sepedas', function (Blueprint $table) {
            $table->id();
            $table->string('merk');
            $table->integer('sewa');
            $table->integer('jumlah');
            $table->string('foto');
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sepedas');
    }
};
