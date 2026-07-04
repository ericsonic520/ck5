<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class menu extends Model
{
    use HasFactory;

    // 資料表名稱
    protected $table = 'menus';
    // 主鍵名稱
    protected $primaryKey = 'menu_id';
    // 可以大量指定異動的欄位(Mass Assignment)
    protected $fillable = [
    	"menu_name",
        "menu_api",
        "menu_caption",
        "menu_description",
        "menu_site",
        "menu_display",
    ];
}
