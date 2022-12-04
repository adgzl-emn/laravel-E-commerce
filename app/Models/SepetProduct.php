<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SepetProduct extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "sepet_products";

    protected $fillable = [
        'sepet_id',
        'product_id',
        'adet',
        'fiyat',
        'durum'
    ];

    public function product()
    {
        return $this->belongsTo(Products::class);
    }

}
