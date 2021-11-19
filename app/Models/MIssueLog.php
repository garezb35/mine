<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MIssueLog extends Model
{
    use HasFactory;
    protected $table = 'm_issue_log';
    protected $guarded = [];
}
