<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewKeywordsFaqList extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faq_list_keywords', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });
        Schema::create('faq_list_rubriques_faq_list_keywords', function (Blueprint $table) {
            $table->integer('faq_list_rubrique_id')->unsigned()->index();
            $table->foreign('faq_list_rubrique_id')->references('id')->on('faq_list_rubriques')->onDelete('cascade');
            $table->integer('faq_list_keyword_id')->unsigned()->index();
            $table->foreign('faq_list_keyword_id')->references('id')->on('faq_list_keywords')->onDelete('cascade');
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
        Schema::drop('faq_list_keywords');
    }
}
