<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function index()
    {
        if (!Auth::check())
        {
            toastr()->error("Giriş Yapmanız Gerekli","İşlem Başarısız!");
            return redirect()->route('login');
        }

        elseif (count(Cart::content()) == 0 )
        {
            toastr()->warning("Sepet Boşken Ödeme alınmaz :)","İşlem Başarısız!");
            return redirect()->route('homepage');
        }

        $kullanici_detay = auth()->user()->detail;

        return view('front.payment',compact('kullanici_detay'));

    }


    public function odemeyap(Request $request)
    {
        $siparis = $request->all();
        $siparis['sepet_id'] = session('aktif_sepet_id');
        $siparis['banka'] = "Garanti";
        $siparis['taksit_sayisi'] = 2;
        $siparis['durum'] = "sipariş alındı";
        $siparis['siparis_tutari'] = Cart::subtotal();


        Order::create($siparis);
        Cart::destroy();
        session()->forget('aktif_sepet_id');

        return redirect()->route('sepet');

    }

}
