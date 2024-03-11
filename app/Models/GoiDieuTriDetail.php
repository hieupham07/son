<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GoiDieuTriDetail extends Model
{
    protected $table = 'goi_dieu_tri_details';
    protected $fillable = [
        'goidieutri_id',
        'vattu_id',
        'so_luong',
    ];
    public function goidieutri()
    {
        return $this->belongsTo(GoiDieuTri::class,'goidieutri_id');
    }
    public function vattu()
    {
        return $this->belongsTo(VatTu::class,'vattu_id');
    }
}