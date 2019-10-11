<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCodigosNegociacaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('codigos_negociacao', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('companhia_id')->nullable(false);
            $table->string('codigo')->nullable(false);
            $table->timestamps();

            $table->foreign('companhia_id')->references('id')->on('companhias');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('codigos_negociacao');
    }
}
