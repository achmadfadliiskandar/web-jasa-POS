<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    public function pakets(){
        return $this->belongsTo(PaketMember::class,'id_pakets');
    }
    public function transaksis(){
        return $this->hasOne(Transaksi::class,'id_members');
    }
}
