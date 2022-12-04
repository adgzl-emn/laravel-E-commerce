<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function past_orders()
    {
        $siparisler = Order::with('sepet')
            ->whereHas('sepet',function ($query){
                $query->where('user_id',auth()->id());
            })
            ->orderByDesc('created_at')->get();
        return view('front.orders.order',compact('siparisler'));
    }

    public function detail($id)
    {
        $detail = Order::with('sepet.sepet_product.product')
            ->whereHas('sepet',function ($query){
                $query->where('user_id',auth()->id());
            })
            ->where('orders.id',$id)->firstOrFail();
        //return $detail;
        return view('front.orders.detail',compact('detail'));

    }

}
