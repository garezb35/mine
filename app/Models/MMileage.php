<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MMileage extends Model
{
    use HasFactory;
    protected $table= 'm_mileage';
    protected $guarded = [];
    const CREATED_AT = "createdByDtm";
    const UPDATED_AT  = "updatedByDtm";

    public function user(){
        return $this->hasOne(User::class,'id','userId');
    }
}
