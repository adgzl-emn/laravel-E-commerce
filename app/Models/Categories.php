<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Products;

class Categories extends Model
{
    protected $table = "categories";


    use SoftDeletes;
    use HasFactory;

    protected $fillable = [
        'ust_id',
        'kategori_adi',
        'slug',
    ];


    public function getProducts()
    {
        return $this->belongsToMany(Products::class,'kategori_uruns');
    }

    public function ust_category()
    {
        return $this->belongsTo(Categories::class,'ust_id')->withDefault([
            'kategori_adi' => 'Ana Kategori'
        ]);
    }


}
