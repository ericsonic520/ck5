<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 建立資料表
        Schema::create('class', function (Blueprint $table) {
            // 課程編號
            $table->increments('id');
            // 用於標記課程狀態，已公開的課程才能被使用者看到
            // - P (Public) : 公開
            // - R (Ruse) : 計畫中
            $table->string('status', 1)->default('R');
            // 課程類別
            $table->string('category', 80)->nullable();
            // 課程名稱
            $table->string('name', 80)->nullable();
            // 課程圖片
            $table->text('pic')->nullable();
            // 課程日期
            $table->date('class_date')->nullable();
            // 課程開始時間
            $table->time('class_start_time')->nullable();
            // 課程結束時間
            $table->time('class_end_time')->nullable();
            // 地址
            $table->string('addr', 150)->nullable();
            // 縣市
            $table->string('county', 80)->nullable();
            // 區域
            $table->string('district', 80)->nullable();
            // 郵遞區號
            $table->string('zipcode', 80)->nullable();
            // 詳細地址
            $table->string('address', 150)->nullable();
            // 課程名額
            $table->string('quota')->nullable();
            // 課程剩餘名額
            $table->string('quota_last')->nullable();
            // 課程介紹
            $table->string('content')->nullable();
            // 時間戳記
            $table->timestamps();

            // 索引設定
            $table->index(['status'], 'class_status_idx');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // 移除資料表
        Schema::dropIfExists('class');
    }
}
