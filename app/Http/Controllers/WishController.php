<?php

namespace App\Http\Controllers;

use App\attribute;
use App\Color;
use App\size;
use Illuminate\Http\Request;
use Str;
use Cookie;
use App\wishlist;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class WishController extends Controller
{
    use SoftDeletes;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function WishAdd($id, $category_id, $subcategory_id, $brand_id)
    {
        $cookie = Cookie::get('cookie_id');
        if ($cookie) {
            $unique = $cookie;
        } else {
            $unique = Str::random(7).rand(1, 1000);
            Cookie::queue('cookie_id', $unique, 43200);
        }


        $exists = wishlist::where('cookie_id', $unique)->where('product_id', $id)->where('category_id', $category_id)->where('subcategory_id', $subcategory_id)->where('brand_id', $brand_id);

        if ($exists->exists()) {
            return back();
        } else {
            $wish = new wishlist;
            $wish->cookie_id = $unique;
            $wish->product_id = $id;
            $wish->category_id =  $category_id;
            $wish->subcategory_id =  $subcategory_id;
            $wish->brand_id =  $brand_id;
            $wish->save();
            return back();
        }
    }






    
    
    public function WishList(Request $request)
    {
        $cookie = Cookie::get('cookie_id');

        if (empty(wishlist::where('cookie_id', $cookie)->get())) {
            return back();
        } 
        else {
        

        if (wishlist::where('cookie_id', $cookie)->exists()) {
            if (wishlist::where('cookie_id', $cookie) == wishlist::where('cookie_id', $cookie)) {
            }

            $id = wishlist::get('product_id');
            $product = wishlist::where('product_id', $id)->get();
            $color = Color::all();
            $size = size::all();
            $attr = attribute::all();
            $wish = wishlist::where('cookie_id', $cookie)->get();
            
            return view('frontend.wish_list', [
            'wish' => $wish,
            'id' => $id,
            'color' => $color,
            'size' => $size,
            'attr' => $attr,
            'product' => $product
            
        ]);
        }
        }
        
        return back();
        
    }



    public function WishProductDelete($id)
    {
        $del = wishlist::findOrFail($id);
        $del->delete();
        return redirect()->route('Shop');
    }



    function WishProductUpdate(Request $request){
  
        foreach($request->wish_id as $key => $data){
            $wish = wishlist::findOrFail($data);
            $wish->quantity = $request->quantity[$key];
            $wish->color_id = $request->color_id;
            $wish->size_id = $request->size_id;
            $wish->save();

            
        }

        
        return back();
    }
}
