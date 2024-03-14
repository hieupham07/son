<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class KhachHang extends Model
{
    // use HasFactory;
    protected $table = 'khach_hangs';
    protected $fillable = [
        'ma_khach',
        'ho_ten',
        'gioi_tinh',
        'ngay_sinh',
        'dien_thoai',
        'dien_thoai1',
        'dia_chi',
        'ghi_chu',
    ];
    public function khachhang()
    {
        return $this->belongsTo(KhachHang::class, 'khach_hang_id');
    }
    public function khach_dieutri()
    {
        return $this->hasMany(KhachDieuTri::class, 'khach_hang_id');
    }
    public function causer(): MorphTo
    {
        return $this->morphTo();
    }
}