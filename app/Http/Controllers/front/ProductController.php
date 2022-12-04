<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Products;


class ProductController extends Controller
{

    public function index($slug)
    {
        $product = Products::whereSlug($slug)->first();
        $getCategory = $product->getCategories()->distinct()->get();
        return view('front.product_detail',compact('product','getCategory'));
    }


    public function search(Request $request)
    {

        $aranan = $request->aranan;
        $search = Products::where('product_name','like','%'.$aranan.'%')
            ->orWhere('aciklama','like','%'.$aranan.'%')
            ->paginate(2);

        $request->flash();
        return view('front.search',compact('search','aranan'));
    }

    public function getProduct()
    {
        $products = Products::paginate(6);
        return view('front.shop',compact('products'));
    }


}
