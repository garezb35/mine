<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MCashReceipt extends Model
{
    use HasFactory;
    protected $table = 'm_cash_receipt';
    protected $guarded = [];
    public function item(){
        return $this->hasOne(MItem::class,'orderNo','orderNo');
    }
    public function payitem(){
        return $this->hasOne(MPayitem::class,'orderNo','orderNo');
    }
}
