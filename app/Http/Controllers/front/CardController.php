<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Products;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use App\Models\Sepet;
use App\Models\SepetProduct;
use Illuminate\Support\Facades\Auth;
use Yoeunes\Toastr\Toastr;

class CardController extends Controller
{
    public function sepet()
    {
        return view('front.sepet');
    }

    public function postCard(Request $request)
    {
        $product = Products::find($request->id);
        $addCart = Cart::add($product->id,$product->product_name,1,$product->fiyat,0,['slug' =>$product->slug]);

        if (auth()->check())
        {
            $aktif_sepet_id = session('aktif_sepet_id');
            if (!isset($aktif_sepet_id))
            {
            $aktif_sepet = Sepet::create([
                'user_id' => auth()->id()
            ]);
            $aktif_sepet_id = $aktif_sepet->id;
            session()->put('aktif_sepet_id',$aktif_sepet_id);   //session a veri atma
            }
            //kayıt tekrar eklıyor duzenlenmesı gerek
            SepetProduct::updateOrCreate(
                ['product_id' => $product->id, 'sepet_id' => $aktif_sepet_id],
                ['adet' => $addCart->qty , 'fiyat' => $product->fiyat , 'durum' => 'Beklemede']);

        }

        toastr()->success("Ürün Sepete Eklendi","İşlem Başarılı");
        return redirect()->route('sepet');
    }

    public function kaldir($rowId)
    {
        if (Auth::check())
        {
            $aktif_sepet_id = session('aktif_sepet_id');
            $cardItem = Cart::get($rowId);
            SepetProduct::where('sepet_id',$aktif_sepet_id)->where('product_id',$cardItem->id)->delete();
        }

        Cart::remove($rowId);
        toastr()->error("Ürün Sepetten Kaldırıldı",'Uyarı!');
        return redirect()->route('sepet');
    }

    public function bosalt()
    {
        if (Auth::check())
        {
            $aktif_sepet_id = session('aktif_sepet_id');
            SepetProduct::where('sepet_id',$aktif_sepet_id)->delete();
        }
        Cart::destroy();
        toastr()->error("Sepet Boşaltıldı",'Uyarı!');
        return redirect()->route('sepet');
    }

    public function guncelle(Request $request, $rowId)
    {
        if (Auth::check())
        {
            $aktif_sepet_id = session('aktif_sepet_id');
            $cardItem = Cart::get($rowId);
            if ($request->adet == 0)
                SepetProduct::where('sepet_id',$aktif_sepet_id)->where('product_id',$cardItem->id)->delete();
            else
                SepetProduct::where('sepet_id',$aktif_sepet_id)->where('product_id',$cardItem->id)
                    ->update(['adet' => $request->adet]);
        }

        Cart::update($rowId ,$request->adet);
        return response()->json(['succsess' => true]);
    }

}
