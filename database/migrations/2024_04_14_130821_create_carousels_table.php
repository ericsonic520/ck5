<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarouselsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carousels', function (Blueprint $table) {
            $table->id('carousel_id');
            $table->string('carousel_title', 255)->nullable();
            $table->string('carousel_description', 255)->nullable();
            $table->string('carousel_image', 255)->nullable();
            $table->string('carousel_display', 255)->nullable();
            $table->string('carousel_range', 255)->nullable();
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
        Schema::dropIfExists('carousels');
    }
}
