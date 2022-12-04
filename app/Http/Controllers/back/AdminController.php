<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function login(Request $request)
    {
        if ($request->isMethod('POST'))
        {
            $credentials = [
                'username' => $request->username,
                'password' => $request->password,
                'admin_check' => 1,
            ];

            if (Auth::guard('admin')->attempt($credentials, $request->hasFile('benihatirla')))
            //iki auth kontrol oldugunda karısıklık onlenmesı ıcın guard fonks. kullanılır
            {
                toastr()->success( 'Hoşgeldin');
                return redirect()->route('admin.homepage');
            }
            else
            {
                toastr()->error( 'Kullanıcı girişi ya da parola hatalı !','Hata');
                return back()->withErrors('Yanlış bir şeyler varr!!');
            }


        }

        return view('back.auth.login');
    }

    public function cikis()
    {
        Auth::guard('admin')->logout();
        session()->flush();
        session()->regenerate();
        toastr()->warning( 'Çıkış Yapıldı !','Hoşçakal');
        return redirect()->route('admin.login');
    }



}
