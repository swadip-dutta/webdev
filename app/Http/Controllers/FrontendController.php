<?php

namespace App\Http\Controllers;

use App\Gallery;
use App\Product;
use App\category;
use Str;
use Cookie;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\attribute;
use App\Blog;
use App\Cart;
use App\Color;
use App\Comment;
use App\message;
use App\ProductReview;
use App\size;
use App\wishlist;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{
    function front(){

        $review = message::all();
        $bestsell = ProductReview::all();

        return view('frontend.home', [
            'products' => Product::latest()->get(),
            'carts' => Cart::latest()->limit(3)->get(),
            'review' => $review,
            'bestsell' => $bestsell
        ]);
       
    }

    

    

    


    function SingleProduct($id) {


        $product = Product::where('id', $id)->first();
        $gallery = Gallery::where('product_id', $product->id)->get();
        $attribute = attribute::where('product_id', $product->id)->get();
        $review = ProductReview::where('product_id', $product->id)->get();
        
        $collection = collect($attribute);
        $groupBy = $collection->groupBy('color_id');
        return view('frontend.single_product', [
            'product' => $product,
            'gallery' =>$gallery,
            'groupBy' =>$groupBy,
            'carts' => Cart::latest()->limit(3)->get(),
            'review' => $review,
            
        ]);
    }

    function GetSize($color, $product){

        $output = '';
        $sizes = attribute::where('color_id', $color)->where('product_id', $product)->get();


        foreach($sizes as $size){
            $output = $output.' <input name="size_id" type="radio" value="'.$size->size_id.'">'.$size->size->size_name.'';
        }
        return $output;
    }



    function Shop(){

        return view('frontend.shop', [
            'cats' => category::orderBy('category_name', 'asc')->get(),
            'products' => Product::all()
        ]);
    }


    function Blogs(){
        
        
        return view('frontend.blogs', [
            'blogs' => Blog::latest()->paginate(3)
        ]);
    }



    function SingleBlog($id){
        
        $blog = Blog::where('id', $id)->first();
        $category = category::orderBy('category_name', 'asc')->get();
        
        
        return view('frontend.blog_details', [
            'blog' => $blog,
            'category' => $category,
            'related' => Blog::where('category_id', $blog->category_id)->get()->except(['id', $blog->id]),
            'comments' => Comment::where('status', 2)->where('blog_id', $blog->id)->latest()->get(),
            // 'current' => Comment::wheredate('created_at', Carbon::now())->get()
        ]);
    }



    function Search(Request $request){


        $product = Product::query();

            if ($request->q)
            {
                // simple where here or another scope, whatever you like
                $product->where('title','LIKE', "%$request->q%");
            }

            if ($request->q)
            {
                $product->orWhere('price','LIKE', "%$request->q%");
            }

            
            $all_product = $product->get();

            return view('frontend.search', [
                'all_product' =>$all_product
            ]);
        }


    function About(){

        $bestsell = ProductReview::all();

        return view('frontend.about', [
            'bestsell' => $bestsell
        ]);
    }


    function Contact(){

        return view('frontend.contact');
    }

    function Message(Request $request){

        $msg = new message;
        $msg->name = $request->name;
        $msg->email = $request->email;
        $msg->subject = $request->subject;
        $msg->message = $request->message;
        $msg->save();

        return back();
    }


                

    





    

}


