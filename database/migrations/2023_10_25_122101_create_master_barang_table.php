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
        Schema::create('master_barang', function (Blueprint $table) {
            $table->id();
            $table->string('kode', 7);
            $table->string('nama', 25)->nullable();
            $table->string('deskripsi')->nullable();
            $table->string('gambar', 255)->nullable();
            $table->integer('id_kategori')->nullable();
            $table->integer('id_gudang')->nullable();
            $table->dateTime('waktu_dibuat')->nullable();
            $table->integer('dibuat_oleh')->nullable();
            $table->dateTime('diperbaharui_kapan')->nullable();
            $table->integer('diperbaharui_oleh')->nullable();
            $table->tinyInteger('status')->default(1);


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
        Schema::dropIfExists('master_barang');
    }
};
