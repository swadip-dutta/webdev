<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class wishlist extends Model
{
    function Product(){
        return $this->belongsTo(Product::class, 'product_id');
    }
    

    function Color(){
        return $this->belongsTo(Color::class, 'color_id');
    }

    function size(){
        return $this->belongsTo(size::class, 'size_id');
    }
}
