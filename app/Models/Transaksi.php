<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    public function detailtransaksi(){
        return $this->hasMany(DetailTransaksi::class,'id_transaksis');
    }
    public function members(){
        return $this->belongsTo(Member::class,'id_members');
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
