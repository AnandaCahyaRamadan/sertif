<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePemesananTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pemesanan', function (Blueprint $table) {
            $table->id();
            $table->DATE('tanggal_pesan');
            $table->string('keterangan',50);
            $table->unsignedBigInteger('pelanggan_id');
            $table->foreign('pelanggan_id')
            ->references('id')
            ->on('pelanggan');
            $table->unsignedBigInteger('gitar_id');
            $table->foreign('gitar_id')
            ->references('id')
            ->on('gitar');
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
        Schema::dropIfExists('pemesanan');
    }
}
