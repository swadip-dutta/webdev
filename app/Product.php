<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    function gallery() {
        return $this->hasMany(Gallery::class, 'product_id');
    }


    function Category() {
        return $this->belongsTo(Category::class, 'category_id');
    }

    function subcategory() {
        return $this->belongsTo(SubCategory::class, 'subcategory_id');
    }

    function attributes(){
        return $this->hasMany(attribute::class, 'product_id');
    }

    function Cart(){
        return $this->hasOne(Cart::class, 'product_id');
    }
}
