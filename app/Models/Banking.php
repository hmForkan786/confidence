<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banking extends Model
{
    protected $fillable = [
        'bank_title',
        'bank_name',
        'account_no',
        'remark',
    ];
}
