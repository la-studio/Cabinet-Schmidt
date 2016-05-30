<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFluxTabletest extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('echosarticles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('image');
            $table->string('auteur');
            $table->string('date');
            $table->string('summary');
            $table->string('content');
            $table->string('title');
            $table->string('rubrique');
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
        Schema::drop('echosarticles');
    }
}
