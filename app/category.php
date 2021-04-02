<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class category extends Model
{
    use SoftDeletes;

    // For Mass update
    protected $fillable = [
        'category_name', 'slug'
    ];

    function get_subcategory(){
        return $this->hasMany('App\SubCategory', 'category_id');
    }


    function Category() {
        return $this->hasMany(Category::class, 'category_id');
    }

    function blog(){
        return $this->hasMany(Blog::class, 'category_id');
    }
}
