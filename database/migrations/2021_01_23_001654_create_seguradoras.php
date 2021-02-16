<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeguradoras extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seguradoras', function (Blueprint $table) {
            $table->id();
            $table->string('no_seguradora', 256)->nullable();
            $table->string('sg_seguradora', 256);
            $table->unsignedBigInteger('status')->nullable();
            $table->foreign('status')->on('status')->references('id');
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
        Schema::dropIfExists('seguradoras');
    }
}
