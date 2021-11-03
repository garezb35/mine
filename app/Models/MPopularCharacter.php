<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MPopularCharacter extends Model
{
    use HasFactory;
    protected $table = 'm_popular_character';
    protected $guarded = [];

    public function game(){
        return $this->hasOne(MGame::class,'id','game_code');
    }
}
