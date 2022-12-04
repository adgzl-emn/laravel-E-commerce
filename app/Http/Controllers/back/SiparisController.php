<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;



class SiparisController extends Controller
{
    public function index(Request $request)
    {
        if ($request->filled('aranan'))
        {
            $request->flash();
            $aranan = $request->aranan;
            $siparisler = Order::with('sepet.user.detail')
                ->where('id',$aranan)
                ->orwhere('banka','like',"%$aranan%")
                ->paginate(8)
                ->appends('aranan',$aranan);
        }
        else{
            $siparisler = Order::with('sepet.user.detail')->orderByDesc('created_at')->paginate(8);
        }

        return view('back.siparis.index',compact('siparisler'));
    }

    public function edit($id = 0)
    {
        $siparis = new Order;
        if ($id > 0)
        {
            $siparis = Order::find($id);
        }

        return view('back.siparis.form',compact('siparis'));

    }

    public function add(Request $request,$id = 0)
    {
        $request->validate([

        ]);

        $siparis = Order::where('id',$id)->first();
        $siparis->siparis_tutari =$request->fiyat;
        $siparis->durum = $request->durum;
        $siparis->save();

        toastr()->success( 'Sipariş Başarı İle Kaydedıldı' ,'İşlem Tamam!');
        return redirect()->route('admin.siparis.edit',$siparis->id);

    }

    public function delete($id)
    {
        $siparis = Order::where('id',$id)->first();
        $siparis->delete();

        toastr()->error( 'Sipariş Başarı İle Kaldırıldı' ,'İşlem Tamam!');
        return redirect()->route('admin.siparisler');

    }

}
