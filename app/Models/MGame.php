<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MGame extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'm_game';
    protected $guarded = [];

    public function twegames(){
        return $this->hasMany(MGame::class,'parent','id')->where("depth",1)->limit(12);
    }

    public function firstOfproperty(){
        return $this->hasOne(MGame::class,'parent','id')->where("depth",2)->orderBy("order","ASC");
    }

    public function threeOfproperty(){
        return $this->belongsTo(MGame::class,'parent','id')->orderBy("order","ASC");
    }

}
