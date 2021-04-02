<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryDeleteRestoreController extends Controller
{
    function CategoryDeleteRestore() {
        
        $trush_category = Category::onlyTrashed()->paginate(2);
        return view('backend.subcategory.delete-restore', [
            'trush_category' => $trush_category
        ]);

    }
}
