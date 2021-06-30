<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    function product(){
        return $this->belongsTo(Product::class, 'product_id');
    }

    function get_color(){
        return $this->belongsTo(Color::class, 'color_id');
    }

    function get_size(){
        return $this->belongsTo(size::class, 'size_id');
    }
}
