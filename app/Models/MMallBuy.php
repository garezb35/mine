<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MMallBuy extends Model
{
    use HasFactory;
    protected $table = 'm_mall_buy';
    protected $guarded = [];
    public function user(){
        return $this->hasOne(User::class,'id', 'userId');
    }
    public function mall(){
        return $this->hasOne(MMall::class,'alias', 'alias');
    }
}
