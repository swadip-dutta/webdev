<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'quantity'
    ];
    function Product(){
        return $this->belongsTo(Product::class, 'product_id');
    }

    function Color(){
        return $this->belongsTo(Color::class, 'color_id');
    }

    function size(){
        return $this->belongsTo(size::class, 'size_id');
    }

    function shipping(){
        return $this->hasMany(shipping::class, 'coupon_discount');
    }
}
