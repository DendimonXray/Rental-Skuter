<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id();

            $table->string('name')->nullable();
            $table->string('nik')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('alamat')->nullable();
            $table->string('user_id')->nullable();

            $table->string('id_skuter')->nullable();
            $table->string('harga')->nullable();
            $table->string('jenis')->nullable();
            $table->string('stock')->nullable();
            $table->string('image')->nullable();
            $table->string('product_id')->nullable();

            $table->string('status_pembayaran')->nullable();
            $table->string('status_peminjaman')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pembayarans');
    }
};
