<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MBargainRequest extends Model
{
    use HasFactory;
    protected $table = 'm_bargain_request';
    protected $guarded = [];

    public function user(){
        return $this->hasOne(User::class,'id','userId');
    }
}
