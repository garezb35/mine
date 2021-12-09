<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MPayhistory extends Model
{
    use HasFactory;
    protected $table = 'm_payhistory';
    protected $guarded = [];
    public function complete_orders(){
        return $this->hasOne(MItem::class,'orderNo','orderNo');
    }

    public function user(){
        return $this->hasOne(User::class,'id','userId');
    }
}
