<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MInbox extends Model
{
    use HasFactory;
    protected $table = 'm_inbox';
    protected  $guarded = [];
    public function payitem(){
        return $this->hasOne(MPayitem::class,'orderNo','orderId');
    }
}
