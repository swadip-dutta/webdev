<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductReview extends Model
{

    function Product(){
        return $this->hasOne(Product::class, 'product_id');
    }

    
}
