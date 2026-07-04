<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class system extends Model
{
   	// 資料表名稱
    protected $table = 'system';
    // 主鍵名稱
    protected $primaryKey = 'id';
    // 可以大量指定異動的欄位(Mass Assignment)
    protected $fillable = [
    	"id",
    	"name",
        "label",
    ];
}
