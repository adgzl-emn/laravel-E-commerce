<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\UserDetail;

class KullaniciController extends Controller
{
    public function index(Request $request)
    {
        if ($request->filled('aranan'))     //aranan degerı dolu ıse
        {
            $aranan = $request->aranan;
            $request->flash();
            $users = User::where('name','like','%'.$aranan.'%')
                ->orwhere('email','like','%'.$aranan.'%')
                ->orwhere('username','like','%'.$aranan.'%')
                ->orderByDesc('created_at')
                ->paginate(7)
                ->appends(['aranan' => $aranan]);
        }
        else
        {
            $users = User::orderByDesc('created_at')->paginate(7);

        }

        return view('back.kullanicilar.index',compact('users'));
    }

    public function edit($id = 0)
    {
        $user = new User();
        if ($id > 0)
        {
            $user = User::findOrFail($id);
        }
        return view('back.kullanicilar.form',compact('user'));

    }

    public function add(Request $request ,$id = 0)
    {

        $request->validate([
            'name'=>'min:3|required',
            'email'=>'required',
            'username' => 'required'
        ]);

        $data = $request->only('name','username','email');
        if ($request->filled('password'))
            $data['password'] = Hash::make($request->password);
        $data['active'] = $request->has('active') ? 1 : 0;
        $data['admin_check'] = $request->has('admin_check') ? 1 : 0;
        //dd( $data['admin_check'] ,$data['active'] );

        if ($id > 0 )
        {
            //guncelle
            $user = User::where('id',$id)->firstOrFail();
            $user->update($data);
        }
        else{
            //kaydet
            $user = User::create($data);
        }

        UserDetail::updateOrCreate(
          ['user_id' => $user->id],
          [
              'address' => $request->address,
              'phone' => $request->tel,
              'postacode' => $request->postcode,
          ]
        );



        return redirect()->route('admin.kullanici.edit',$user->id)->withErrors();

    }

    public function delete($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->route('admin.kullanicilar');
    }

}
