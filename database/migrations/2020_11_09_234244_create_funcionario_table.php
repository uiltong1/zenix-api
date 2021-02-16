<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFuncionarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('funcionario', function (Blueprint $table) {
            $table->unsignedBigInteger('id');
            $table->string('cpf', 14)->nullable();
            $table->integer('idade');
            $table->string('telefone', 14);
            $table->unsignedBigInteger('perfil_id');
            $table->foreign('id')->references('id')->on('users');
            $table->foreign('perfil_id')->references('id')->on('perfil')->onDelete('cascade');
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
        Schema::dropIfExists('pessoas');
    }
}
