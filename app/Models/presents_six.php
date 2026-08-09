<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class presents_six extends Model
{
    use HasFactory;
    // 資料表名稱
    protected $table = 'presents_six';
    // 主鍵名稱
    protected $primaryKey = 'resume_six_id';
    // 可以大量指定異動的欄位(Mass Assignment)
    protected $fillable = [
        'resume_sixname',
        'resume_six_display',
    ];
}
