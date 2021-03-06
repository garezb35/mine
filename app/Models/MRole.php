<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MRole extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'm_role';
    public function rolegift(){
        return $this->hasMany(MRoleGift::class,'role_id','id');
    }
}
