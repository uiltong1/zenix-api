<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTipoPlanos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipo_planos', function (Blueprint $table) {
            $table->id();
            $table->string('no_tipo_plano', 14)->nullable();
            $table->unsignedBigInteger('status')->nullable();
            $table->timestamps();
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
        Schema::dropIfExists('tipo_planos');
    }
}
