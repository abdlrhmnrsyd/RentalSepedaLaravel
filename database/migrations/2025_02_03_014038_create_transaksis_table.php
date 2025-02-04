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
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('peminjam_id')->constrained('peminjams')->onDelete('cascade');
            $table->foreignId('sepeda_id')->constrained('sepedas')->onDelete('cascade');
            $table->date('tgl_pinjam');
            $table->date('tgl_pulang');
            $table->integer('bayar');
            $table->integer('denda')->nullable();
            $table->string('jaminan');
            $table->string('status');
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
