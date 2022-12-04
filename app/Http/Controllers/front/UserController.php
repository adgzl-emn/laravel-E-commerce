<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Mail\Mails;
use App\Models\Sepet;
use App\Models\SepetProduct;
use App\Models\UserDetail;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function register()
    {
        return view('front.kullanici.register');
    }


    public function registerPost(Request $request)
    {
        $request->validate([
            'name'=>'required|min:3',
            'username'=>'required|min:2',
            'password' => 'required|confirmed|min:5',
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->activation_key = Str::random(60);
        $user->active = 0;

        $user->save();

        //$user->detail()->save(new UserDetail());

        Mail::to($request->email)->send(new Mails($user));

        Auth::login($user);
        toastr()->info( $request->username .' merhaba lutfen mailini onaylayın','Hoşgeldin');
        return redirect()->route('homepage');



    }


    public function aktivasyon($key)
    {
       print_r($key);
       die();
   //    $user = User::where('activation_key',$key)->first();
   //    if (!is_null($user))
   //    {
   //        $user->activation_key = null;
   //        $user->active = 1;
   //        $user->save();

   //        toastr()->success( $user->name .' Aramıza Hoşgeldin','o7');
   //        return redirect()->route('homepage');
   //    }
   //    else {
   //        toastr()->error( 'Kullanıcı Maili Onayalanamadı','Hata');
   //        return redirect()->route('homepage');
   //    }

    }

    public function login()
    {
        return view('front.kullanici.login');
    }


    public function loginPost(Request $request)
    {

        $data = $request->only('username', 'password');
        if(Auth::attempt($data, $request->has('selector') ))
        {
            $request->session()->regenerate();

            /** login olundugunda db == session olması ıcın
             * 1. adım
             -- Sessionda olan bılgılerı db atıldı yoksa guncellendı --        */

           // $aktif_sepet_id = Sepet::firstOrCreate(['user_id' => auth()->id()])->id;
            $aktif_sepet_id = Sepet::aktif_sepet_id();
            if (is_null($aktif_sepet_id))
            {
                $aktif_sepet = Sepet::create(['user_id' => auth()->id()]);
                $aktif_sepet_id = $aktif_sepet->id;
            }

            session()->put('aktif_sepet_id',$aktif_sepet_id);   //sepet id çekildi ve sessiona aktarıldı

            /** 2. adım
             *Sessionda olan bılgılerı db atıldı yoksa guncellendı
             */
            if (Cart::count()>0)
            {
                foreach (Cart::content() as $cartItem)
                {
                    SepetProduct::updateOrCreate(
                        ['sepet_id'=> $aktif_sepet_id , 'product_id' => $cartItem->id],
                        ['adet' => $cartItem->qty , 'fiyat' => $cartItem->price , 'durum' => 'beklemede' ]
                    );
                }
            }
            /** 3. adım
            --session tekrar guncelledık --
             */
            Cart::destroy();
            /** 4. adım
            --DB dekı urunlerı sessiona tekrar ektarıldı --
             */
            $sepetUrunler = SepetProduct::with('product')->where('sepet_id',$aktif_sepet_id)->get();
            foreach ($sepetUrunler as $sepetUrun)
            {
               Cart::add($sepetUrun->product->id , $sepetUrun->product->product_name , $sepetUrun->adet,
                   $sepetUrun->product->fiyat,0,['slug' =>$sepetUrun->product->slug]);

            }
            //end

            toastr()->success('Tekrar Hosşeldin '.Auth::user()->name,'Giriş Başarılı');
            return redirect()->intended('/home');
        }
        else
        {
            //return $request->all();
            toastr()->error( 'Kullanıcı girişi ya da parola hatalı !','Hata');
            return back();
        }

    }


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->flush();
        $request->session()->regenerate();
        toastr()->warning( 'Çıkış Yapıldı !','Hoşçakal');
        return redirect()->route('homepage');
    }


}
