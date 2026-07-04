<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddProviderIdToUsersTable extends Migration
{
    // 執行資料庫異動
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // 加入 facebook_id 欄位到 password 欄位後方
            $table->string('provider_id', 30)
                ->nullable()
                ->after('email');
            
            // 建立索引
            // $table->index(['type'], 'user_fb_idx');
        });
    }
    
    // 復原資料庫異動
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // 移除欄位
            $table->dropColumn('provider_id');
        });
    }
}
