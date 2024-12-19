<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSiteConfigurationsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('site_configurations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title_place');
            $table->string('subtitle_place');
            $table->string('title_news');
            $table->string('subtitle_news');
            $table->string('title_events');
            $table->string('subtitle_events');
            $table->string('title_team');
            $table->string('subtitle_team');
            $table->text('description_team');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('site_configurations');
    }
}
