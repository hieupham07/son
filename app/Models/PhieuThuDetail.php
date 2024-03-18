<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhieuThuDetail extends Model
{
    protected $table = 'phieu_thu_details';
    protected $fillable = [
        'phieu_thu_id',
        'tieu_de',
        'content',
        'gia_tien',
        'soluong_goi',
    ];
    public function phieuthu()
    {
        return $this->hasMany(PhieuThu::class, 'phieu_thu_id');
    }
}
