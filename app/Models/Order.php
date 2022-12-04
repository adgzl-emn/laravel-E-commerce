<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    protected $table = "orders";

    use SoftDeletes;
    use HasFactory;

    protected $fillable = [
        'sepet_id',
        'siparis_tutari',
        'banka',
        'taksit_sayisi',
        'durum',
        ];

    public function sepet()
    {
        return $this->belongsTo(Sepet::class);
    }


}
