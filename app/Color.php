<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    function Attribute() {
        return $this->hasMany(Attribute::class, 'color_id');
    }

    function Cart(){
        return $this->hasMany(Cart::class, 'color_id');
    }


    function wishlist(){
        return $this->hasMany(wishlist::class, 'color_id');
    }
}
