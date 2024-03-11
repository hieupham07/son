<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GoiDieuTriKhach extends Model
{
    // use HasFactory;
    protected $table = 'goi_dieu_tri_khaches';
    protected $fillable = [
        'khach_hang_id ',
        'goi_dt_id ',
        'trang_thai',
    ];
    public function khachhang()
    {
        return $this->belongsTo(KhachHang::class,'khach_hang_id');
    }
    public function goidieutri()
    {
        return $this->belongsTo(GoiDieuTri::class,'goi_dt_id');
    }
}
