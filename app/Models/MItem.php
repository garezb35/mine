<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MItem extends Model
{
    use HasFactory;
    protected $table= 'm_item';
    protected $guarded = [];

    public function user(){
        return $this->hasOne(User::class,'id','userId');
    }

    public function other(){
        return $this->hasOne(User::class,'id','toId');
    }

    public function game(){
        return $this->hasOne(MGame::class,'id','game_code');
    }
    public function server(){
        return $this->hasOne(MGame::class,'id','server_code');
    }

    public function payitem(){
        return $this->hasOne(MPayitem::class,'orderNo','orderNo');
    }

    public function bargains(){
        return $this->hasMany(MBargainRequest::class,'orderNo','orderNo');
    }

    public function premium(){
        return $this->hasOne(MPremium::class,'post_id','id')
            ->where('type',1)
            ->where('until','>',date("Y-m-d H:i:s"));
    }

    public function premiums(){
        return $this->hasMany(MPremium::class,'post_id','id')
            ->where('until','>',date("Y-m-d H:i:s"));
    }

}
