<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSiteSocialNetworksTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('site_social_networks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('url')->unique();
            $table->integer('social_network_id')->unsigned()->unique();
            $table->timestamps();
            $table->foreign('social_network_id')->references('id')->on('social_networks');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('site_social_networks');
    }
}
