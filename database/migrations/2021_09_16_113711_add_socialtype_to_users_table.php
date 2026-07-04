<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSocialTypeToUsersTable extends Migration
{
    // 執行資料庫異動
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // 加入 facebook_id 欄位到 password 欄位後方
            $table->string('social_type', 30)
                ->nullable()
                ->after('id');
            
            // 建立索引
            // $table->index(['type'], 'user_fb_idx');
        });
    }
    
    // 復原資料庫異動
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // 移除欄位
            $table->dropColumn('social_type');
        });
    }
}
