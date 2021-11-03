<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MChgame extends Model
{
    use HasFactory;
    protected $table = 'm_chgame';
    protected $guarded = [];

    public function chgames(){
        return $this->hasOne(MGame::class,'id','game_id')->orderBy('order','ASC');
    }

    public function bb(){
        return $this->belongsTo(MGame::class,'game_id','id');
    }
}
