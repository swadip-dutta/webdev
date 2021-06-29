<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWishlistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wishlists', function (Blueprint $table) {
            $table->id();
            $table->string('cookie_id');
            $table->foreignId('product_id');
            $table->foreignId('category_id');
            $table->foreignId('subcategory_id');
            $table->foreignId('brand_id');
            $table->foreignId('color_id')->nullable();
            $table->foreignId('size_id')->nullable();
            $table->tinyInteger('quantity')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wishlists');
    }
}
