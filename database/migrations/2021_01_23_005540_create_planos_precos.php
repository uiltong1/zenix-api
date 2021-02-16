<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanosPrecos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('planos_precos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_plano')->nullable();
            $table->integer('idade_inicio');
            $table->integer('idade_fim');
            $table->float('preco');
            $table->float('vl_comissao');
            $table->float('qt_comissao');
            $table->unsignedBigInteger('status')->nullable();
            $table->timestamps();
            $table->foreign('id_plano')->references('id')->on('planos')->onDelete('cascade');
            $table->foreign('status')->on('status')->references('id');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('planos_precos');
    }
}
