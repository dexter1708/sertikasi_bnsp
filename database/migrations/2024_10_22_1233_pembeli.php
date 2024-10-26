<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pembeli', function (Blueprint $table) {
            $table->id('pembeli_id');
            $table->string('nama_pembeli');
            $table->string('alamat_pembeli');
            $table->decimal('total_pembelian', 10, 2)->default(0);
            $table->timestamp('tanggal_daftar')->useCurrent();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pembeli');
    }
};
