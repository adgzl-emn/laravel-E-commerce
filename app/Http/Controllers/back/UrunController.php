<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\ProductsDetail;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Products;
use Illuminate\Support\Str;

//NOTE :::::  Bir Urune Ait Birden Fazla Resim yap 1 e çok ılıskı kurup yap!!

class UrunController extends Controller
{
    public function index(Request $request)
    {
        if ($request->filled('aranan'))
        {
            $request->flash();
            $aranan = $request->aranan;
            $products = Products::where('product_name','like',"%$aranan%")
                ->orderByDesc('created_at')
                ->paginate(7)
                ->appends('aranan',$aranan);
        }
        else
        {
            $products = Products::orderByDesc('created_at')->paginate(8);
        }

        return view('back.urun.index',compact('products'));

    }

    public function edit($id = 0)
    {
        $urun = new Products;
        $urun_kategoriler = [];
        if ($id > 0)
        {
            $urun = Products::find($id);
            // pluck ==> sadece bır sutunu ceker
            $urun_kategoriler = $urun->getCategories()->pluck('categories_id')->all();
        }
        $kategoriler = Categories::all();

        return view('back.urun.form',compact('urun','kategoriler','urun_kategoriler'));
    }

    public function add(Request $request ,$id = 0)
    {
        $request->validate([

        ]);

        $data = $request->only('product_name','fiyat','aciklama');
        $data['slug'] = Str::slug($request->product_name);

        // $indirim = $request->has('goster_indirimli') ? 1 : 0;  indimdeğeri işaretlenmış ise 1 degıl ise 0

        $product_detay = $request->only('goster_slider','goster_gunun_firsati','goster_one_cikan',
        'goster_cok_satan' , 'goster_indirimli');


        $secilen_kategoriler = $request->secilen_kategoriler;

        if ($id >0)
        {
            $urun = Products::where('id',$id)->first();
            $urun->update($data);
            $urun->getDetail()->update($product_detay);
            $urun->getCategories()->sync($secilen_kategoriler);
        }
        else
        {
            $urun = Products::create($data);
            $urun->getDetail()->create($product_detay);
            $urun->getCategories()->attach($secilen_kategoriler);
        }

        if ($request->hasFile('urun_image'))
        {
            $request->validate([
                'urun_image' => 'image|mimes:jpg,jpeg,png,gif|max:2048'
            ]);

            $urun_image = $request->file('urun_image');  //bir dosya bilgisini bir değişkene aktarılabılır
            $urun_image = $request->urun_image;
            $dosya_adi = $urun->slug . '.' .$urun_image->extension();

            if ($urun_image->isValid())
            {
                $urun_image->move('uploads/urunler',$dosya_adi);

                ProductsDetail::updateOrCreate(
                    ['products_id' => $urun->id],
                    ['image' => $dosya_adi]
                );
            }

        }


        toastr()->success( 'Ürün Başarı İle Kaydedıldı' ,'İşlem Tamam!');
        return redirect()->route('admin.urunler');

    }

    public function adddbg(Request $request ,$id = 0)
    {
        $request->validate([

        ]);

        $data = $request->only('product_name','fiyat','aciklama');
        $data['slug'] = Str::slug($request->product_name);

        // $indirim = $request->has('goster_indirimli') ? 1 : 0;  indimdeğeri işaretlenmış ise 1 degıl ise 0

        $product_detay = $request->only('goster_slider','goster_gunun_firsati','goster_one_cikan',
            'goster_cok_satan' , 'goster_indirimli');

        if ($id >0)
        {
            return "guncelledi";
           //$urun = Products::where('id',$id)->first();
           //$urun->update($data);
           //$urun->getDetail()->update($product_detay);

        }
        else
        {
            return "ekledi";

        }

        toastr()->success( 'Ürün Başarı İle Kaydedıldı' ,'İşlem Tamam!');
        return redirect()->route('admin.urunler');

    }


    public function delete($id)
    {
        $urun = Products::find($id);
        //$urun->getCategories()->detach();
        $urun->getDetail()->delete();
        $urun->delete();

        toastr()->error( 'Ürün Başarı İle Kaldırıldı' ,'İşlem Tamam!');
        return redirect()->route('admin.urunler');
    }

    /*
     Silinen Ürünün Geri Dönüşümü Ve Tamamen Kaldırılması

       public function trashed(){
        $articles = Articles::onlyTrashed()->orderBy('deleted_at','DESC')->get();
        return view('back/articles/trashed',compact('articles'));
    }
    public function recover($id){
        Articles::onlyTrashed()->findOrFail($id)->restore();
        toastr()->success('Yazı geri dönüştürüldü');
        return redirect()->route('yazilar.index');
    }

    public function forceDelete($id){
        $article = Articles::onlyTrashed()->findOrFail($id);
        if (File::exists($article->image)){
            File::delete(public_path($article->image));
        }
        $article->forceDelete();
        toastr()->error('Yazı Tamamen Kaldırıldı');
        return redirect()->route('silinen');
    }


     */


}
