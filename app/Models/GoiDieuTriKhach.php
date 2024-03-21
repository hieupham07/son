<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GoiDieuTriKhach extends Model
{
    // use HasFactory;
    protected $table = 'goi_dieu_tri_khaches';
    protected $fillable = [
        'khach_hang_id',
        'goi_dt_id',
        'sl_buoi',
    ];
    public function khachhang()
    {
        return $this->hasMany(KhachHang::class,'khach_hang_id');
    }
    public function goidieutri()
    {
        return $this->hasMany(GoiDieuTri::class,'goi_dt_id');
    }
    public function dieutri()
    {
        return $this->hasMany(KhachHangGoi::class,'goi_dieu_tri_id');
    }

}