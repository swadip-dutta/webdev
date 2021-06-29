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


    function wishlist(){
        return $this->hasOne(wishlist::class, 'product_id');
    }



    function ProductReview(){
        return $this->hasOne(ProductReview::class, 'product_id');
    }




    function ProductRev(){
        return $this->hasOne(ProductReview::class, 'product_id');
    }

    

    // function Productreview(){
    //     return $this->belongsTo(Product::class, 'product_id');
    // }

    
}
