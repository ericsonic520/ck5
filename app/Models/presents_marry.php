<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class presents_marry extends Model
{
    use HasFactory;
     // 資料表名稱
    protected $table = 'presents_marry';
    // 主鍵名稱
    protected $primaryKey = 'resume_marry_id';
    // 可以大量指定異動的欄位(Mass Assignment)
    protected $fillable = [
        'resume_marry_name',
        'resume_marry_display',
    ];
}
