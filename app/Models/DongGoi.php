<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DongGoi extends Model
{
    // use HasFactory;
    protected $table = 'dong_gois';
    protected $fillable = [
        'ten',
        'ghi_chu',
        'sua',
    ];
    // public function donggoi()
    // {
    //     return $this->hasMany(Thuoc::class, 'id');
    // }
}