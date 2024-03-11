<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        return $this->hasMany(DungCuGoi::class, 'goi_id');
    }
}
