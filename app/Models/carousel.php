<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class carousel extends Model
{
    use HasFactory;
    // 資料表名稱
    protected $table = 'carousels';
    // 主鍵名稱
    protected $primaryKey = 'carousel_id';
    // 可以大量指定異動的欄位(Mass Assignment)
    protected $fillable = [
    	"carousel_title",
    	"carousel_description",
        "carousel_image",
        "carousel_display",
        "carousel_range",
    ];
}
