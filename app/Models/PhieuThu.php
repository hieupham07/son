<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhieuThu extends Model
{
    // use HasFactory;
    protected $table = 'phieu_thus';
    protected $fillable = [
        'ma_phieuthu',
        'khach_hang_id',
        'goi_id',
        'tien_thanhtoan',
        'tien_con',
        'ghi_chu',
    ];
    public function khachhang()
    {
        return $this->belongsTo(KhachHang::class, 'khach_hang_id');
    }
    public function details()
    {
        return $this->hasMany(PhieuThuDetail::class, 'phieu_id');
    }
    public function goi_dt()
    {
        return $this->hasMany(GoiDieuTri::class, 'goi_id');
    }
    public function phieuthu(): MorphTo
    {
        return $this->morphTo();
    }
}
