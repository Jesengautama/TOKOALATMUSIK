<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id('id_transaksi'); // Primary Key
            $table->unsignedBigInteger('produk_id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('id_nota')->nullable(); // Jika ada nota
            $table->integer('qty');
            $table->bigInteger('harga_produk');
            $table->string('nama_produk');
            $table->bigInteger('total_harga');
            $table->string('status')->default('pending');
            $table->date('tanggal')->nullable();
            $table->string('metode_pembayaran');
            $table->timestamps();

            // Foreign key (opsional, bisa disesuaikan dengan relasi)
            $table->foreign('produk_id')->references('id_produk')->on('produk')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};
