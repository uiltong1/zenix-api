<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('planos', function (Blueprint $table) {
            $table->id();
            $table->string('no_plano', 256)->nullable();
            $table->string('detalhes');
            $table->unsignedBigInteger('id_seguradora')->nullable();
            $table->unsignedBigInteger('id_tipo_plano')->nullable();
            $table->String('contrato', 3)->nullable();
            $table->unsignedBigInteger('status')->nullable();
            $table->timestamps();
            $table->foreign('id_seguradora')->references('id')->on('seguradoras');
            $table->foreign('id_tipo_plano')->references('id')->on('tipo_planos');
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
        Schema::dropIfExists('planos');
    }
}
