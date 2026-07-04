<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class pluss extends Model
{
        // 資料表名稱
    protected $table = 'pluss';
    // 主鍵名稱
    protected $primaryKey = 'id';
    // 可以大量指定異動的欄位(Mass Assignment)
    protected $fillable = [
    	"id",
    	"class_id",
        "user_id",
    	"nickname",
    	"birth",
    	"phone",
    	"city",
    	"email",
        "class_quota",
    ];
}
