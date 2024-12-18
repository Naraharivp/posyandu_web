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
        Schema::create('mengantri', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pelanggan');
            $table->string('kode_antrian');
            $table->text('alamat');
            $table->string('nomor_hp');
            $table->string('id_layanan_tsd');
            $table->string('user_id');
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
        //
    }
};
