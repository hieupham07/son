<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VatTu extends Model
{
    // use HasFactory;
    protected $table = 'vat_tus';
    protected $fillable = [
        'ten',
        'mo_ta',
        'loai_id',
        'goi_id',
        'sua',
    ];
    public function donggoi()
    {
        return $this->belongsTo(DongGoi::class, 'goi_id');
    }
    public function loaivattu()
    {
        return $this->belongsTo(LoaiVatTu::class, 'loai_id');
    }
}
