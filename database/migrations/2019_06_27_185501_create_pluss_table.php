<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlussTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pluss', function (Blueprint $table) {
            // 加入編號
            $table->increments('id');
            // 選擇商品ID
            $table->string('class_id', 200);
            // 選擇商品ID
            $table->string('user_id', 200);
            // 姓名
            $table->string('nickname', 20)->nullable();
            // 生日
            $table->date('birth')->nullable();
            // 電話
            $table->string('phone', 50);
            // 地址
            $table->string('city', 150)->nullable();
            // 信箱
            $table->string('email');
            // 課程數量
            $table->string('class_quota')->nullable();
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
        Schema::dropIfExists('pluss');
    }
}
