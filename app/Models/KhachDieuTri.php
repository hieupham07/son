<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

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
    public function khachdt()
    {
        return $this->hasOne(KhachHangGoi::class,'goi_dieu_tri_id');
    }
    public function goi_dt_cua_khach()
    {
        return $this->hasMany(GoiDieuTriKhach::class,'khach_hang_id');
    }

    public function goidieutri()
    {
        return $this->belongsTo(GoiDieuTri::class,'goi_d_t_id');
    }
    public function causer(): MorphTo
    {
        return $this->morphTo();
    }
}