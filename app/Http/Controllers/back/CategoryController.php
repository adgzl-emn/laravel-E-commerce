<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categories;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index(Request $request)
    {

        /**
        if(isset($aranan) && isset($ust_id)){
        $list=$query->with('ust_kategori')
        ->where('kategori_adi','like',"%$aranan%")
        ->where('ust_id',$ust_id)
        ->orderByDesc('id')
        ->paginate(8)
        ->appends(['aranan' => $aranan,'ust_id' => $ust_id]);
        }
        else if(isset($aranan) && is_null($ust_id)) {
        $list=$query->with('ust_kategori')
        ->where('kategori_adi','like',"%$aranan%")
        ->orderByDesc('id')
        ->paginate(8)
        ->appends(['aranan' => $aranan,'ust_id' => $ust_id]);
        }
        else if(is_null($aranan) && isset($ust_id)) {
        $list=$query->with('ust_kategori')
        ->where('ust_id',$ust_id)
        ->orderByDesc('id')
        ->paginate(8)
        ->appends(['aranan' => $aranan,'ust_id' => $ust_id]);
        }
        }
         */

        if ($request->filled('aranan') || $request->filled('anakategori'))
        {

            $request->flash();
            $aranan = $request->aranan;
            $anakategori = $request->anakategori;

            $categories = Categories::with('ust_category')
                ->where('kategori_adi','like','%'.$aranan.'%')
                ->where('ust_id',$anakategori)
                ->orderByDesc('created_at')
                ->paginate(2)
                ->appends(['aranan' => $aranan , 'anakategori' => $anakategori]);
        }
        else
        {
            request()->flush();
            $categories = Categories::with('ust_category')->orderByDesc('created_at')->paginate(7);
        }

        $anacategorys = Categories::whereRaw('ust_id is null')->get();

        return view('back.kategori.index',compact('categories','anacategorys'));
    }

    public function edit($id = 0)
    {
        $categories = new Categories;
        if ($id > 0)
        {
            $categories = Categories::find($id);
        }
        $allcategori = Categories::all();
        return view('back.kategori.form',compact('categories','allcategori'));

    }

    public function add(Request $request, $id = 0)
    {

        $request->validate([
            'kategori_adi'=>'min:1|required',
            'slug' => 'unique:categories,slug'
        ]);
//
        $data = $request->only('ust_id','kategori_adi');
        $data['slug'] = Str::slug($request->kategori_adi);


        if (Categories::whereSlug($data['slug'])->count() > 0 )
        {
            return back()->withInput()->withErrors(['Slug' => 'Slug Değerleri Aynı Olamaz']);
        }

        if ($id > 0)
        {
            $entry = Categories::where('id',$id)->firstOrFail();
            $entry->update($data);
        }
        else{
            $entry = Categories::create($data);
        }

        return redirect()->route('admin.kategoriler',$entry->id);

    }

    /**
    Many To Many yapılarda ekleme ve silme işlemleri
    attach => ekleme    detach => Temile olarak kullanılır.
     */

    public function delete($id)
    {
        $category = Categories::find($id);
        $category->getProducts()->detach();
        $category->delete();

        toastr()->error( 'Kategori Başarı İle Kaldırıldı' ,'İşlem Tamam!');
        return redirect()->route('admin.kategoriler');
    }





}
