<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTransaksi extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function transaksi(){
        return $this->belongsTo(Transaksi::class);
    }
    public function barangs(){
        return $this->belongsTo(Barang::class,'id_barangs');
    }
}
