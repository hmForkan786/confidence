<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Banking extends Model
{
    use HasFactory;

    protected $fillable = [
        'bank_title',
        'bank_name',
        'account_no',
        'remark',
    ];
}
