<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class post extends Model
{
    use HasFactory;

    // 資料表名稱
    protected $table = 'posts';
    // 主鍵名稱
    protected $primaryKey = 'post_id';
    // 可以大量指定異動的欄位(Mass Assignment)
    protected $fillable = [
        'post_title',
        'post_sort',
        'post_description',
        'post_site',
        'post_display',
        'post_time',
    ];
}
