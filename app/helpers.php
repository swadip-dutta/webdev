<?php

use App\attribute;
use App\Cart;
use App\ProductReview;
use App\Product;
use App\User;
use App\wishlist;
use App\Message;

function cart(){
    $cookie = Cookie::get('cookie_id');

    return Cart::where('cookie_id', $cookie)->get();
}

function wishlist(){
    $cookie = Cookie::get('cookie_id');

    return wishlist::where('cookie_id', $cookie)->get();
}

function attribute(){
    return attribute::all();
}

function UserReview(){
    return ProductReview::latest()->get(); 
    return User::get('id');

}

function Message(){
    return Message::latest()->get();
    return User::get('id');
}


function ProductReview(){
    $review = Product::get('id');
    return ProductReview::where('id', $review)->get();
}

?>