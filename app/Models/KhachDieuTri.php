<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KhachDieuTri extends Model
{
    // use HasFactory;
    protected $table = 'khach_dieu_tris';
    protected $fillable = [
        'khach_hang_id',
        'goi_d_t_id',
        'goi_dieu_tri_id',
        'so_buoi_con',
    ];
    public function khachhang()
    {
        return $this->belongsTo(KhachHang::class,'khach_hang_id');
    }
    public function goidieutri()
    {
        return $this->belongsTo(GoiDieuTri::class,'goi_d_t_id');
    }
}
