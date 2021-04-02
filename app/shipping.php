<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class shipping extends Model
{
    function Cart(){
        return $this->belongsTo(Cart::class, 'coupon_discount');
    }
}
