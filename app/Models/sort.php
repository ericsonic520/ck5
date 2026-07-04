<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sort extends Model
{
    use HasFactory;
    
     // 資料表名稱
     protected $table = 'sorts';
     // 主鍵名稱
     protected $primaryKey = 'sort_id';
     // 可以大量指定異動的欄位(Mass Assignment)
     protected $fillable = [
         'sort_name',
         'sort_name_en',
         'sort_display',
     ];
}
