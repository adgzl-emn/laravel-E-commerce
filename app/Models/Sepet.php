<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Sepet extends Model
{
    protected $table = "sepets";


    use HasFactory;
    use SoftDeletes;


    protected $fillable = [
        'user_id',
    ];

    public function order()
    {
        return $this->hasOne(Order::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function sepet_product()
    {
        return $this->hasMany(SepetProduct::class);
    }

    public static function aktif_sepet_id()
    {
        $aktif_sepet = DB::table('sepets as s')
            ->leftJoin('orders as or','or.sepet_id','=','s.id')
            ->where('s.user_id',auth()->id())
            ->whereRaw('or.id is null')    //whereRaw kendi sorgularımızı yazmak ıcın kullanılır.
            ->orderByDesc('s.created_at')
            ->select('s.id')
            ->first();

        if (!is_null($aktif_sepet)) return $aktif_sepet->id;
    }

    public function sepet_urun_adet()
    {
        return DB::table('sepet_products')->where('sepet_id',$this->id)->sum('adet');
    }

    public function getUser()
    {
        //neden olmadı bul
        $user = DB::table('sepets as s')
            ->leftJoin('users as u','s.user_id','=','u.id')
            ->whereRaw('u.id is null')
            ->orderByDesc('s.created_at')
            ->select('u.id')
            ->first();
        if (!is_null($user)) return $user->id;
    }




}
