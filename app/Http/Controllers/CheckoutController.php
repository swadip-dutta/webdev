<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Country;
use App\City;
use App\State;
use Cookie;
use Illuminate\Http\Request;
use App\Http\Controllers\Session;
use App\wishlist;

class CheckoutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    function Checkout(Request $request){
        $cookie = Cookie::get('cookie_id');
        
        $carts = Cart::where('cookie_id', $cookie)->get();

        $value = $request->session()->get('coupon_dis');
        
        $countries = Country::orderBy('name', 'asc')->get();

        $wish = wishlist::where('cookie_id', $cookie)->get();

        $value_c = Cart::where('cookie_id', $cookie)->get();
        $value_w = wishlist::where('cookie_id', $cookie)->get();
        
        return view('frontend.checkout', [
            'carts' => $carts,
            'countries' => $countries,
            'value' => $value,
            'wish' => $wish,
            'value_c' => $value_c,
            'value_w' => $value_w
            
            
        ]);
        // Session::get('coupon_dis');
        
    }

    function GetState($id){
       $states = State::where('country_id', $id)->get();

       return response()->json($states);
    }

    function GetCity($city_id){
        $cities = City::where('state_id', $city_id)->get();

        return response()->json($cities);
    }
    
    
}
?>