<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSurveyDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('survey_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('survey_id');
            $table->foreignId('komoditi_id');
            $table->bigInteger('harga')->default(0);
            $table->integer('range')->default(0);
            $table->enum('status', ['KOSONG', 'NAIK', 'TURUN', 'STABIL']);
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
        Schema::dropIfExists('survey_details');
    }
}
