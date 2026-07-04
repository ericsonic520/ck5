<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 建立資料表
        Schema::create('news', function (Blueprint $table) {
            // 新聞編號
            $table->increments('id');
            // 新聞標題
            $table->string('title', 80)->nullable();
            // 新聞圖片
            $table->text('pic')->nullable();
            // 新聞內容
            $table->string('content')->nullable();
            // 時間戳記
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
        Schema::dropIfExists('news');
    }
}
