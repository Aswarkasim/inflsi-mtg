<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRekapSurveysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rekap_surveys', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kecamatan_id');
            $table->foreignId('komoditi_id');
            $table->date('tanggal');
            $table->bigInteger('harga')->default(0);
            $table->bigInteger('selisih')->default(0);
            $table->enum('status', ['KOSONG', 'NAIK', 'TURUN', 'STABIL']);
            $table->string('komoditi_name')->nullable();
            $table->string('kecamatan_name')->nullable();
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
        Schema::dropIfExists('rekap_surveys');
    }
}
