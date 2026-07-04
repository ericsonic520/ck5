<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class breadcrumb extends Model
{
    use HasFactory;
    // 資料表名稱
    protected $table = 'breadcrumbs';
    // 主鍵名稱
    protected $primaryKey = 'breadcrumb_id';
    // 可以大量指定異動的欄位(Mass Assignment)
    protected $fillable = [
    	"breadcrumb_name",
    	"breadcrumb_name_en",
    	"breadcrumb_api",
        "breadcrumb_display"
    ];
}
