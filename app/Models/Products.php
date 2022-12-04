<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Categories;
use App\Models\ProductsDetail;

class Products extends Model
{
    protected $table = "products";

    use SoftDeletes;
    use HasFactory;

    protected $fillable = [
        'product_name',
        'slug',
        'aciklama',
        'fiyat',
        'images'
    ];


    public function getCategories()
    {
        return $this->belongsToMany(Categories::class,'kategori_uruns');
    }
    public function getDetail()
    {
        return $this->hasOne(ProductsDetail::class,'products_id','id');
        //detay eklenmemıs durumda null hatası yememek ıcın  $this->hasOne(ProductsDetail::class)->withDefault()  şeklinde kullanılabılır ya da ıf de isset şeklınde sorgu yapılarbılır
    }


}
