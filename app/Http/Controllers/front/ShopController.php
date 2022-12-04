<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\Products;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index()
    {
        $categories = Categories::whereRaw('ust_id is null')->get();
        $products = Products::paginate(6);
        return view('front.shop',compact('categories','products'));
    }



    public function kategori(Request $request, $slug)
    {
        $categories = Categories::where('slug',$slug)->firstOrFail();
        $alt_kategori = Categories::where('ust_id',$categories->id)->get();
        $getProducts = $categories->getProducts()->paginate(6);
        return view('front.categorie',compact('alt_kategori','categories','getProducts'));
    }


}
