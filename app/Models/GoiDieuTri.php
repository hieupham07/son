<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class GoiDieuTri extends Model
{
    // use HasFactory;
    protected $table = 'goi_dieu_tris';
    protected $fillable = [
        'ten',
        'mo_ta',
        'gia',
        'giam_gia',
        'so_buoi',
        'ghi_chu',
        'sua',
    ];
    public function dungcugoi()
    {
        return $this->hasMany(GoiDieuTriDetail::class, 'goidieutri_id');
    }
    // public function khachhang()
    // {
    //     return $this->hasMany(KhachHang::class, 'goidieutri_id');
    // }
    // public function details()
    // {
    //     return $this->hasMany(QuoteDetail::class, 'quote_id');
    // }
    public function goidt(): MorphTo
    {
        return $this->morphTo();
    }
}
