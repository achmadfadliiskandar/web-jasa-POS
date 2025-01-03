<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    public function barang(){
        return $this->belongsTo(Barang::class,'id_barangs');
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
