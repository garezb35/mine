<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MPrivateMessage extends Model
{
    use HasFactory;
    protected $table = 'm_private_message';
    protected $guarded = [];

    public function u1(){
        return $this->hasOne(User::class,'id','userId1');
    }
    public function u2(){
        return $this->hasOne(User::class,'id','userId2');
    }
}
