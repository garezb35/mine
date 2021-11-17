<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MPayitem extends Model
{
    use HasFactory;
    protected $table = 'm_payitem';
    protected $guarded = [];
    public function  complete_orders(){
        return $this->hasOne(MItem::class,'orderNo','orderNo');
    }
}
