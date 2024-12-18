<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    public function carts(){
        return $this->hasOne(Cart::class);
    }
    public function detailtransaksi(){
        return $this->hasMany(DetailTransaksi::class,'id_barangs');
    }
}
