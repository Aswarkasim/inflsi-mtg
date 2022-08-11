<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSurveysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surveys', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('pasar_id');
            $table->foreignId('desa_id');
            $table->foreignId('kecamatan_id');
            $table->date('tanggal')->nullable();
            // $table->foreignId('komoditi_id');
            // $table->bigInteger('harga')->default(0);
            // $table->bigInteger('range_last')->default(0);
            // $table->enum('status', ['KOSONG', 'NAIK', 'TURUN', 'STABIL']);
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
        Schema::dropIfExists('surveys');
    }
}
