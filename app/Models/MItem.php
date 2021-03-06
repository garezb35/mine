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

    public function bargain_requests(){
        return $this->hasMany(MBargainRequest::class,'orderNo','orderNo')->where(function($query){
            $query->where('status',0);
            $query->orWhere("status",1);
        });
    }

    public function bargainByUser(){
        return $this->hasOne(MBargainRequest::class,'userId','userId');
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

    public function privateMessage(){
        return $this->hasOne(MPrivateMessage::class,'orderNo','orderNo');
    }

    public function ask(){
        return $this->hasOne(MAsk::class,'order_no','orderNo')->where('type','complete')->orWhere('type','cancel');
    }

}
