<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class presents_skill_type extends Model
{
    use HasFactory;
    // 資料表名稱
    protected $table = 'presents_skill_type';
    // 主鍵名稱
    protected $primaryKey = 'resume_skill_type_id';
    // 可以大量指定異動的欄位(Mass Assignment)
    protected $fillable = [
        'resume_skill_type_name',
        'resume_skill_type_display',
    ];
}
