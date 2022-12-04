<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Products;
use Illuminate\Http\Request;
use App\Models\Categories;
use App\Models\ProductsDetail;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$urun_slider = ProductsDetail::with('getProducts')->where('goster_slider',1)->get();

        $slider = DB::table('products')
            ->join('product_details','products_id','=','products.id')
            ->where('product_details.goster_slider', 1)
            ->orderBy('products.created_at' ,'desc')
            ->get();

        $gunun_firsati = DB::table('products')
            ->join('product_details','products_id','=','products.id')
            ->where('product_details.goster_gunun_firsati', 1)
            ->orderBy('products.created_at' ,'desc')
            ->first();

        $one_cikan = DB::table('products')
            ->join('product_details','products_id','=','products.id')
            ->where('product_details.goster_one_cikan', 1)
            ->orderBy('products.created_at' ,'desc')
            ->get();

        $cok_satan = DB::table('products')
            ->join('product_details','products_id','=','products.id')
            ->where('product_details.goster_cok_satan', 1)
            ->orderBy('products.created_at' ,'desc')
            ->get();

        $indirimli = DB::table('products')
            ->join('product_details','products_id','=','products.id')
            ->where('product_details.goster_indirimli', 1)
            ->orderBy('products.created_at' ,'desc')
            ->get();
        //return $gunun_firsati;
        return view('front.index',compact('slider','gunun_firsati','one_cikan','cok_satan','indirimli'));
    }


    public function try()
    {
        return view('front.search');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
