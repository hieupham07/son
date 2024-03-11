<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DungCuGoi extends Model
{
    protected $table = 'dung_cu_gois';
    protected $fillable = [
        'goi_id',
        'vat_tu_id',
        'ghi_chu',
    ];
    // use HasFactory;
    public function goidieutri()
    {
        return $this->belongsTo(GoiDieuTri::class,'goi_id');
    }
}
