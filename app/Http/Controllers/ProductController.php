<?php

namespace App\Http\Controllers;

use App\brand;
use App\color;
use App\Category;
use App\Product;
use App\SubCategory;
use App\attribute;
use App\Gallery;
use Carbon\Carbon;
use CreateBrandsTable;
use Illuminate\Http\Request;
use Image;
use Illuminate\Support\Str;
use App\Size;
use Illuminate\Support\Facades\File;
use League\CommonMark\Extension\Attributes\Node\Attributes;

class ProductController extends Controller
{
    public function products()
    {
        return view('backend.product.product-list', [
            'products' => Product::paginate(),
            'product_count' => Product::count()
        ]);
    }

    public function ProductAdd()
    {

        // $categories = Category::all();
        // $scat = SubCategory::all();

        return view('backend.product.product-from', [

            'scat' => SubCategory::orderBy('subcategory_name', 'asc')->get(),
            'categories' => Category::orderBy('category_name', 'asc')->get(),
            'brands' => Brand::orderBy('brand_name', 'asc')->get(),
            'colors' => Color::orderBy('color_name', 'asc')->get(),
            'sizes' => Size::orderBy('size_name', 'asc')->get(),
        ]);
    }

    public function ProductStore(Request $request)
    {
        if ($request->hasFile('thumbnail')) {
            $image = $request->file('thumbnail');
            $ext = Str::random(10).'.'.$image->getClientOriginalExtension();
            Image::make($image)->save(public_path('images/'. $ext));
            $product_id =  Product::insertGetId([
                'title' => $request->title,
                'price' => $request->price,
                'summary' => $request->summary,
                'description' => $request->description,
                'brand_id' => $request->brand_id,
                'category_id' => $request->category_id,
                'subcategory_id' => $request->subcategory_id,
                'thumbnail' =>$ext,
                'created_at' => Carbon::now()
            ]);
            
            foreach ($request->color_id as $key => $value) {
                attribute::insert([
                    'color_id' => $value,
                    'product_id' => $product_id,
                    'size_id' => $request->size_id[$key],
                    'quantity' => $request->quantity[$key],
                    'created_at' => Carbon::now()
                ]);
            }

            if ($request->hasFile('images')) {
                $images = $request->file('images');

            $new_location = public_path('gallery/')
            . Carbon::now()->format('Y/m/')
            . $product_id . '/';

                File::makeDirectory($new_location, $mode = 0777, true, true);
            

                foreach ($images as $img) {
                    $img_ext = Str::random(10).'.'.$img->getClientOriginalExtension();
                    Image::make($img)->save($new_location. $img_ext);
                
                    Gallery::insert([
                    'product_id' => $product_id,
                    'images' => $img_ext,
                    'created_at' => Carbon::now()
                ]);
                }
            }
        }
    }

    public function ProductEdit($id)
    {
        return view('backend.product.product-edit', [
            

            'brands' => Brand::all(),
            'categories' => Category::all(),
            'product' => Product::where('id', $id)->first()
        ]);
    }

    public function ProductUpdate(Request $request)
    {
        

        $product = Product::findOrFail($request->product_id);

        if ($request->hasFile('thumbnail')) {
            $image = $request->file('thumbnail');
            $ext = Str::random(10).'.'.$image->getClientOriginalExtension();

            $old_img_location = public_path('images/'.$product->thumbnail);
            if (file_exists($old_img_location)) {
                unlink($old_img_location);
            }

            Image::make($image)->save(public_path('images/'. $ext));

            $product->thumbnail = $ext;
        }

        $product->price = $request->price;
        $product->title = $request->title;
        $product->summary = $request->summary;
        $product->slug =Str::slug($request->title);
        $product->brand_id = $request->brand_id;
        $product->description = $request->description;
        $product->category_id = $request->category_id;
        $product->subcategory_id = $request->subcategory_id;
        $product->save();

        return "ProductUpdate";
    }


    function CategoryAjax($id){

        $scat = SubCategory::where('category_id', $id)->get();

        return response()->json($scat);
    }


    function ProductImageEdit($id) {

        $product_id = Product::where('id', $id)->first();
        $gellary = Gallery::where('product_id', $product_id->id)->get();
        return view('backend.product.product_image_edit', [
           'gellary' => $gellary, 
           'product_id'=> $product_id->id
        ]);
 }

    function ImageGalleryDelete($id) {
        $Gallery = Gallery::findOrFail($id);
        $old_image = public_path('gallery/'.$Gallery->created_at->format('Y/m/').$Gallery->product_id.'/'.$Gallery->images);
        if(file_exists($old_image)){
            unlink($old_image);
            $Gallery->delete();

            return back();
        }       
    }

    function MultiImageUpdate(Request $request) {
        if($request->hasFile('images')) {

            $product_id = $request->product_id;

            $images = $request->file('images');

            $new_location = public_path('gallery/')
            . Carbon::now()->format('Y/m/')
            . $product_id . '/';

            File::makeDirectory($new_location, $mode = 0777, true, true);
            

            foreach ($images as $img) {
                $img_ext = Str::random(10).'.'.$img->getClientOriginalExtension();
                Image::make( $img)->resize(500, 500)->save($new_location. $img_ext);
                
                // Gallery::insert([
                //     'product_id' => $product_id,
                //     'images' => $img_ext,
                //     'created_at' => Carbon::now()
                // ]);

                $update_image = new Gallery;
                $update_image->product_id = $product_id;
                $update_image->images = $img_ext;
                $update_image->save();

            }

            return back();

            }
    }

    function ProductDelete($id) {
        $product = Product::findOrFail($id);

        $old_image = public_path('images/'.$product->thumbnail);
        if(file_exists($old_image)){
            // return "thumbnail";
            unlink($old_image);
            

            
        }
       $gallery = Gallery::where('product_id', $product->id)->get();
       foreach ($gallery as $item) {
           $oldimg = public_path('gallery/'.$item->created_at->format('Y/m/').$item->product_id.'/'.$item->images);
           if (file_exists($oldimg)) {
            //    return "images";
            unlink($oldimg);
            $item->delete();
           }
       } 
       $product->delete();
       return "Deleted Successfully";      
    }

}