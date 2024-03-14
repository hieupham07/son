<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Thuoc extends Model
{
    // use HasFactory;
    protected $table = 'thuocs';
    protected $fillable = [
        'ten',
        'gia',
        'giam_gia',
        'dong_goi_id',
        'content',
        'ghi_chu',
    ];

    public function donggoi()
    {
        return $this->hasOne(DongGoi::class, 'dong_goi_id');
    }
    public function thuoc(): MorphTo
    {
        return $this->morphTo();
    }
}