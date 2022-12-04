<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Products;

class ProductsDetail extends Model
{
    protected $table = "product_details";

    use HasFactory;

    protected $fillable = [
        'image',
        'goster_slider',
        'goster_gunun_firsati',
        'goster_one_cikan',
        'goster_cok_satan',
        'goster_indirimli'
    ];


    public function getProducts()
    {
        return $this->belongsTo(Products::class,'products_id');
    }

}
