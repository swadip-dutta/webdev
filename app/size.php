<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class size extends Model
{
    function Attribute() {
        return $this->hasMany(Attribute::class, 'size_id');
    }

    function get_order(){
        return $this->hasOne(Order::class, 'size_id');
    }

    function Cart(){
        return $this->hasMany(Cart::class, 'size_id');
    }

    function wishlist(){
        return $this->hasMany(wishlist::class, 'size_id');
    }
}
