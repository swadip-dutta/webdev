<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class shipping extends Model
{
    use SoftDeletes;
    function Cart(){
        return $this->belongsTo(Cart::class, 'coupon_discount');
    }
}
