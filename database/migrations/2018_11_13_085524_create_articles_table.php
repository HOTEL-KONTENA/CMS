<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('CMS_articles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->bigInteger('user_id');
            $table->dateTime('published_at');
            $table->string('cover_image');
            $table->text('content');
            $table->text('external_link')->nullable();
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
        Schema::dropIfExists('CMS_articles');
    }
}
