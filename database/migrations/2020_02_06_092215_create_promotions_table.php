<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePromotionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('CMS_promotions', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('user_id');
            $table->string('title');
            $table->string('cover_image');
            $table->dateTime('start_at');
            $table->dateTime('end_at')->nullable();
            $table->string('description')->nullable();
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
        Schema::dropIfExists('CMS_promotions');
    }
}
