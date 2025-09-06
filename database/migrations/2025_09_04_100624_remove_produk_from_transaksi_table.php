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
        Schema::table('transaksi', function (Blueprint $table) {
            // Hapus foreign key dulu
            $table->dropForeign(['id_produk']);
            
            // Baru hapus kolom
            $table->dropColumn(['id_produk', 'jumlah']);
        });
    }

    public function down()
    {
        Schema::table('transaksi', function (Blueprint $table) {
            $table->unsignedBigInteger('id_produk');
            $table->integer('jumlah');

            $table->foreign('id_produk')->references('id')->on('produk');
        });
    }

};
