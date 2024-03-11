<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoaiVatTu extends Model
{
    // use HasFactory;

    protected $table = 'loai_vat_tus';
    protected $fillable = [
        'ten',
        'mo_ta',
        'goi_id ',
        'sua',
    ];
    public function vattu()
    {
        return $this->hasMany(VatTu::class, 'loai_id');
    }

}
