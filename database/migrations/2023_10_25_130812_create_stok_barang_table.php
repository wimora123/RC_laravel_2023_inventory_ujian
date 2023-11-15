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
        Schema::create('stok_barang', function (Blueprint $table) {
            $table->id();
            $table->string('kode', 7);
            $table->integer('stok_masuk')->nullable();
            $table->integer('stok_keluar')->nullable();
            $table->integer('stok_sisa')->nullable();
            $table->integer('stok_minimal')->nullable();
            $table->dateTime('waktu_dibuat')->nullable();
            $table->integer('dibuat_oleh')->nullable();
            $table->dateTime('diperbaharui_kapan')->nullable();
            $table->integer('diperbaharui_oleh')->nullable();

            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stok_barang');
    }
};
