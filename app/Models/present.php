<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class present extends Model
{
    use HasFactory;

    // 資料表名稱
    protected $table = 'presents';
    // 主鍵名稱
    protected $primaryKey = 'resume_id';
    // 可以大量指定異動的欄位(Mass Assignment)
    protected $fillable = [
        'resume_nickname',
        'resume_name',
        'resume_picme',
        'resume_sex',
        'resume_age',
        'resume_marry',
        'resume_education',
        'resume_cellphone',
        'resume_email',
        'resume_summary',
        'resume_introduction',
        'resume_experience',
        'resume_skill',
        'resume_sideproject',
        'resume_job_intro',
        'resume_display',
    ];
}
