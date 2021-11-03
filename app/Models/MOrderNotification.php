<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MOrderNotification extends Model
{
    use HasFactory;
    protected  $table = "m_order_notification";
    protected  $guarded = [];
}
