<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class course extends Model
{
    // 資料表名稱
    protected $table = 'class';
    // 主鍵名稱
    protected $primaryKey = 'id';
    // 可以大量指定異動的欄位(Mass Assignment)
    protected $fillable = [
    	"id",
    	"status",
    	"category",
    	"name",
    	"pic",
    	"class_date",
    	"class_start_time",
    	"class_end_time",
    	"addr",
    	"county",
    	"district",
        "zipcode",
    	"address",
        "quota",
        "quota_last",
        "content",
    ];
}
