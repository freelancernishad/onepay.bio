<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'userid',
        'client_userid',
        'token',
        'amount',
        'status',
    ];


    function user() {
        return $this->belongsTo(User::class,'userid');
    }


}
