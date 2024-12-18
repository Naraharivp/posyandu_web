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
        Schema::create('poli_tsd', function (Blueprint $table) {
            $table->id();
            $table->string('nama_poli_tsd');
            $table->string('kode_poli_tsd');
            $table->string('deskripsi');
            $table->string('slug')->unique('poli_tsd_slug_unique');
            $table->string('syarat');
            $table->integer('kouta');
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
