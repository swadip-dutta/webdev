<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Carbon\Carbon;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CategoryController extends Controller
{


    function __construct()
    {
        $this->middleware('verified');
    }



    function CategoryList() {
        $categories = Category::paginate();
        $trush_category = Category::onlyTrashed()->paginate();
        return view('backend.category.category-list', [
            'categories' => $categories,
            'trush_category' => $trush_category
        ]);
    }


    function CategoryPost(Request $req) {

             //Validation
            $req->validate([
            'category_name' => ['required', 'min:3', 'unique:categories', 'regex:/^[A-Za-z0-9 \-]*$/']
            ],
            //  [ 'category_name.required' => 'Please Enter Your Name' ]
        );

            $data = new Category;
            $data->category_name = $req -> category_name;
            $data->slug = Str::slug($req -> category_name);
            $data->save();



            // Category::insert([
            //     'category_name' => $req ->category_name,
            //     'created_at' => Carbon::now()
            // ]);
            return back()->with('CategoryAdd', 'Category Added Successfuly');
    }

    function CategoryDelete($id){

        $cat_product = Product::where('category_id', $id)->count();
        if($cat_product > 0){
            return back()->with('delete1', "You Can't Delete This Category");
        }

        else{
            Category::findOrFail($id)->delete();
            return back()->with('delete2', "Category Deleted Successfully");
        }
        
    }



    function CategoryRestore($id){
        Category::withTrashed()->findOrFail($id)->restore();
        return back();
    }

    function PermanentDelete($id){
        Category::withTrashed()->findOrFail($id)->forceDelete();
        return back()->with('PermanentDelete', 'Category Deleted Successfuly');
    }

    function CategoryEdit($id){
        $categories = Category::paginate();
        $trush_category = Category::onlyTrashed()->paginate();
        $edit_category = Category::findOrFail($id);

        return view('backend.category.category-edit', [
            'categories' => $categories,
            'trush_category' => $trush_category,
            'edit_category' =>  $edit_category
            ]);
    }

    function CategoryUpdate(Request $req) {

       

        // Mass Update
        // Category::findOrFail($req->id)->update([
        //     'category_name' => $req->category_name,
        //     'slug' => Str::slug($req->category_name),
        //     'update_at' => Carbon::now()
        // ]);


        // Eloquent Update
           $update = Category::findOrFail($req->id);
           $update-> category_name = $req->category_name;
           $update-> slug = Str::slug($req->category_name);
           $update-> save();

        return back();
    }
    
    function SelectedCategoryDelete(Request $request){

        if($request->cat_id != ''){
            foreach($request->cat_id as $cat){
                Category::findOrFail($cat)->delete();
                
            }
            return back();
        }

       

    }
}
