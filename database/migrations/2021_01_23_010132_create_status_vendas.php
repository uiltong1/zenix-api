<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatusVendas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('status_vendas', function (Blueprint $table) {
            $table->id();
            $table->string('no_status_venda')->nullable();
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
        Schema::dropIfExists('status_vendas');
    }
}
