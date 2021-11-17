<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MNotice extends Model
{
    use HasFactory;
    protected $table = 'm_notice';
    protected $guarded = [];
}
