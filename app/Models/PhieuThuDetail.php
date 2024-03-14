<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhieuThuDetail extends Model
{
    protected $table = 'phieu_thu_details';
    protected $fillable = [
        'phieu_thu_id',
        'content',
    ];
    public function phieuthu()
    {
        return $this->belongsTo(PhieuThu::class, 'phieu_thu_id');
    }
}
