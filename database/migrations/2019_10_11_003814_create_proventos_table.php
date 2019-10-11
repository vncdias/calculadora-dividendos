<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProventosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proventos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('companhia_id')->nullable(false);
            $table->enum('tipo_ativo', ['ON', 'PN'])->nullable(false);
            $table->enum('tipo_provento', ['DIVIDENDO', 'JCP'])->nullable(false);
            $table->decimal('valor_provento', 9, 7)->nullable(false);
            $table->date('data_aprovacao');
            $table->date('data_ultimo_preco')->nullable(false);
            $table->decimal('ultimo_preco', 5, 2);
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
        Schema::dropIfExists('proventos');
    }
}
