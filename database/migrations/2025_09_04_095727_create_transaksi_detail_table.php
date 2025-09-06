<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transaksi_detail', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_transaksi'); // relasi ke transaksi
            $table->unsignedBigInteger('id_produk');    // relasi ke produk
            $table->integer('jumlah');                  // jumlah produk yang dipesan
            $table->integer('harga');                   // harga saat pembelian
            $table->timestamps();

            // foreign key
            $table->foreign('id_transaksi')->references('id')->on('transaksi')->onDelete('cascade');
            $table->foreign('id_produk')->references('id')->on('produk')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transaksi_detail');
    }
};
