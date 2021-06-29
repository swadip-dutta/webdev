<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductReview extends Model
{

    function ProductRev(){
        return $this->belongsTo(Product::class, 'product_id');
    }


    function Product(){
        return $this->belongsTo(Product::class, 'product_id');
    }

    

    
}
