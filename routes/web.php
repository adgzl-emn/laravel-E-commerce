<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\front\HomeController;
use App\Http\Controllers\front\ShopController;
use App\Http\Controllers\front\ProductController;
use App\Http\Controllers\front\UserController;
use App\Http\Controllers\front\CardController;
use App\Http\Controllers\front\PaymentController;
use App\Http\Controllers\front\OrdersController;
use App\Http\Controllers\back\AdminController;
use App\Http\Controllers\back\HomepageController;
use App\Http\Controllers\back\KullaniciController;
use App\Http\Controllers\back\CategoryController;
use App\Http\Controllers\back\UrunController;
use App\Http\Controllers\back\SiparisController;
use App\Models\User;
use App\Mail\Mails;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//FRONTTT

//anasayfa
Route::get('/',[HomeController::class,'index'])->name('homepage');
//shop sayfası
Route::get('/shop',[ShopController::class,'index'])->name('shoppage');
Route::get('/shop/kategori/{slug_kategori}',[ShopController::class,'kategori'])->name('kategori');
//urun detay
Route::get('/urun/{slug_product}',[ProductController::class,'index'])->name('productdetail');
//arama
Route::post('/ara',[ProductController::class,'search'])->name('search');
Route::get('/ara',[ProductController::class,'search'])->name('search');
//login register
Route::get('/register',[UserController::class,'register'])->name('register');
Route::post('/register',[UserController::class,'registerPost'])->name('registerpost');
Route::get('/login',[UserController::class,'login'])->name('login');
Route::post('/login',[UserController::class,'loginPost'])->name('loginpost');
Route::post('/logout',[UserController::class,'logout'])->name('logout');
//Sepet  CardController
Route::get('/sepet',[CardController::class,'sepet'])->name('sepet');
Route::post('/card',[CardController::class,'postCard'])->name("postCard");
Route::delete('/bosalt',[CardController::class,'bosalt'])->name('sepet.bosalt');
Route::delete('/sepet/{rowId}',[CardController::class,'kaldir'])->name('sepet.kaldir');
Route::patch('/sepet/guncelle{rowId}',[CardController::class,'guncelle'])->name('sepet.guncelle');

//activate
//Route::get('/activate/{key}',[UserController::class,'aktivasyon']);
Route::get('/activate/{key}',function ($key){
    $user = User::where('activation_key',$key)->first();
    if (!is_null($user))
    {
        $user->activation_key = null;
        $user->active = 1;
        $user->save();
        toastr()->success( $user->name .' Aramıza Hoşgeldin','o7');
        return redirect()->route('homepage');
    }
    else {
        toastr()->error( 'Kullanıcı Maili Onayalanamadı','Hata');
        return redirect()->route('homepage');
    }
});


Route::group(['middleware' => 'auth'],function (){
    //odemeler
    Route::get('/odeme',[PaymentController::class,'index'])->name('odeme');
    Route::post('/odemeyap',[PaymentController::class,'odemeyap'])->name('odeme.yap');
    //siparişler
    Route::get('/siparisler',[OrdersController::class,'past_orders'])->name('gecmis.siparisler');
    Route::get('/siparisler/{id}',[OrdersController::class,'detail'])->name('siparis.detay');
});

//::::::::::::::::::::::::::::::: BACKK :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::


Route::match(['get','post'],'admin/login',[AdminController::class,'login'])->name('admin.login');

    Route::prefix('admin')->middleware('isAdmin')->namespace('back')->group(function (){
                                                                    //controller adresı

        Route::get('/homepage',[HomepageController::class,'index'])->name('admin.homepage');
        Route::get('/cikis',[AdminController::class,'cikis'])->name('admin.cikis');
        //Kullanici Kontrol
        Route::get('kullanicilar',[KullaniciController::class,'index'])->name('admin.kullanicilar');
        Route::post('kullanicilar',[KullaniciController::class,'index'])->name('admin.kullanicilar.post');
        Route::get('kullanici/ekle',[KullaniciController::class,'edit'])->name('admin.kullanici.ekle');
        Route::get('kullanici/edit/{id}',[KullaniciController::class,'edit'])->name('admin.kullanici.edit');
        Route::post('kullanici/kayit/{id?}',[KullaniciController::class,'add'])->name('admin.kullanici.add');
        Route::get('kullanici/delete/{id}',[KullaniciController::class,'delete'])->name('admin.kullanici.delete');
        //kategorı
        Route::match(['get','post'],'kategoriler',[CategoryController::class,'index'])->name('admin.kategoriler');
        Route::get('kategori/edit/{id?}',[CategoryController::class,'edit'])->name('admin.kategori.edit');
        //Route::get('kategori/edit',[CategoryController::class,'form'])->name('admin.kategori.edit');
        Route::post('kategori/kayit/{id?}',[CategoryController::class,'add'])->name('admin.kategori.add');
        Route::get('kategori/sil/{id}',[CategoryController::class,'delete'])->name('admin.kategori.delete');
        //urun
        Route::match(['get','post'],'urunler',[UrunController::class,'index'])->name('admin.urunler');
        Route::get('urun/edit/{id?}',[UrunController::class,'edit'])->name('admin.urun.edit');
        Route::post('urun/kayit/{id?}',[UrunController::class,'add'])->name('admin.urun.add');
        Route::get('urun/sil/{id}',[UrunController::class,'delete'])->name('admin.urun.delete');
        //siparisler
        Route::match(['get','post'],'siparisler',[SiparisController::class,'index'])->name('admin.siparisler');
        Route::get('siparis/edit/{id?}',[SiparisController::class,'edit'])->name('admin.siparis.edit');
        Route::post('siparis/edit/{id?}',[SiparisController::class,'add'])->name('admin.siparis.add');
        Route::get('siparis/sil/{id}',[SiparisController::class,'delete'])->name('admin.siparis.delete');


    });
