<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MAsk extends Model
{
    use HasFactory;

    protected $table= 'm_ask';
    protected $guarded = [];

    public function  user(){
        return $this->hasOne(User::class,'id','create_id');
    }
}
