<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MMygame extends Model
{
    use HasFactory;
    protected $table = 'm_mygame';
    protected $guarded = [];

    public function fgame(){
        return $this->hasOne(MGame::class,'id','game');
    }
}
