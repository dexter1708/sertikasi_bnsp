<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('buku', function (Blueprint $table) {
            $table->id('buku_id');
            $table->string('nama');
            $table->string('penulis');
            $table->unsignedBigInteger('kategori_id');
            $table->string('penerbit');
            $table->string('gambar');
            $table->integer('harga');
            $table->integer('stok');
            $table->date('tanggal_terbit');
            $table->timestamps();

            $table->foreign('kategori_id')->references('kategori_id')->on('kategori');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buku');
    }
};
