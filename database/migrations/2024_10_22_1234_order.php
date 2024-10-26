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
        Schema::create('orders', function (Blueprint $table) {
            $table->id('order_id');
            $table->unsignedBigInteger('buku_id')->nullable();
            $table->unsignedBigInteger('pembeli_id')->nullable(); // Ubah menjadi nullable
            $table->integer('jumlah');
            $table->integer('subtotal');
            $table->timestamp('tanggal_order')->useCurrent();
            $table->enum('status', ['Diproses', 'Selesai', 'Batal'])->default('Diproses');

            // Foreign key constraints
            $table->foreign('buku_id')->references('buku_id')->on('buku')->onDelete('set null');
            $table->foreign('pembeli_id')->references('pembeli_id')->on('pembeli')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
