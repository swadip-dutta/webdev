<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Cookie;
use Str;
use App\Cart;
use App\Coupon;
use Carbon\Carbon;
use App\Http\Controllers\Session;


class CartController extends Controller
{
    
    function AddToCart(Request $request){
       
        $cookie = Cookie::get('cookie_id');
        if($cookie){
            $unique = $cookie;
        }
        else{
            $unique = Str::random(7).rand(1,1000);
            Cookie::queue('cookie_id', $unique, 43200);
        }

        $exists = Cart::where('cookie_id', $unique)->where('product_id', $request->product_id)->where('color_id', $request->color_id)->where('size_id', $request->size_id);

        if($exists->exists()){
            $exists->increment('quantity', $request->quantity);
        }
        else {
            $cart = new Cart;
            $cart->cookie_id = $unique;
            $cart->product_id = $request->product_id;
            $cart->quantity = $request->quantity;
            $cart->color_id = $request->color_id;
            $cart->size_id = $request->size_id;
            $cart->save();
        }
        
        return redirect()->route('Cart');
    }

    function Cart(Request $request){
        $coupon_discount = 0;
        $code = $request->coupon_code;
        if($code == ''){ 

            $cookie = Cookie::get('cookie_id');
            return view('frontend.cart', [
            'carts' => Cart::where('cookie_id', $cookie)->get(),
            'coupon_discount' => $coupon_discount
        ]);
        }

        else{
            $cookie = Cookie::get('cookie_id');

            if(Coupon::where('code', $code)->exists()) {
                $carts = Cart::where('cookie_id', $cookie)->get();
                $valid_date = Coupon::where('code', $code)->first();
                if(Carbon::now()->format('Y-m-d') <= $valid_date->validity){

                    if($valid_date->level == 'amount'){
                        $coupon_discount =  $valid_date->discount;
                    }
                    else{
                        $total = 0;
                        foreach($carts as $cart){
                            $total += $cart->product->price * $cart->quantity;
                        }

                        if($total > 600){
                            $coupon_discount =($total / 100) * $valid_date->discount;
                            // Session::put('coupon_dis', $coupon_discount);
                            //  $value =  Session::put('coupon_dis', $coupon_discount);
                        }

                        else{
                            return back()->with('discount_pay', "you have buy minimun $600");
                        }

                        
                    }
                }
                else{
                    return "Invalid";
                }
            }
            else{
                return "Code Doesn't Found";
            }

            return view('frontend.cart', [
            'carts' => $carts,
            'coupon_discount' => $coupon_discount,
            'code' =>$code

        ]);
        }

        
    }

    function CartProductUpdate(Request $request){
        return "ok";
        foreach($request->cart_id as $key => $data){
            $cart = Cart::findOrFail($data);
            $cart->quantity = $request->quantity[$key];
            $cart->save();
            return back();
            
        }
        return back();
    }


    function CartProductDelete($id){
        $del = Cart::findOrFail($id);
        $del->delete();
        return back();
    }


    
}
?>