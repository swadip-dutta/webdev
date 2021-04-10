<?php

namespace App\Http\Controllers;

use App\Gallery;
use App\Product;
use App\category;
use Str;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\attribute;
use App\Blog;
use App\Cart;
use App\Comment;
use App\ProductReview;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Cookie;

class FrontendController extends Controller
{
    function front(){

        $review = ProductReview::latest()->limit(4)->get();

        return view('frontend.home', [
            'products' => Product::latest()->limit(4)->get(),
            'carts' => Cart::latest()->limit(3)->get(),
            'review' => $review
        ]);
       
    }

    function GetReview($product, $review) {

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

            
            echo $all_product = $product->get();
                }



    

}


