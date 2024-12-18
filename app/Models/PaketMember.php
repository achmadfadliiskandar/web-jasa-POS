<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaketMember extends Model
{
    use HasFactory;

    public function members(){
        return $this->hasOne(Member::class);
    }
}
