<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class site extends Model
{
    use HasFactory;

    // 資料表名稱
    protected $table = 'sites';
    // 主鍵名稱
    protected $primaryKey = 'site_id';
    // 可以大量指定異動的欄位(Mass Assignment)
    protected $fillable = [
        'site_title',
        'site_description',
        'site_name',
        'site_name_en',
        'site_lineid',
        'site_wechartid',
        'site_cellphone',
        'site_address',
        'site_blade',
        'site_display',
        'site_maintain',
        'site_maintain_caption',
    ];
}
