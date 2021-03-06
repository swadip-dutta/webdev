<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Cart Product Update
Route::post('update-to-cart', 'CartController@updatetocart')->name('updatetocart');

//Search 

Route::get('/search', 'FrontendController@Search')->name('Search');


// Shipping

Route::post('/shipping/update', 'HomeController@ShippingUpdate')->name('ShippingUpdate');

Route::get('/shipping/list', 'HomeController@ShippingList')->name('ShippingList');

Route::get('/shipping/delete/{id}', 'HomeController@ShippingDelete')->name('ShippingDelete');

Route::get('/shipping/search', 'HomeController@ShippingSearch')->name('ShippingSearch');

Route::get('/shipping/edit/{id}', 'HomeController@ShippingEdit')->name('ShippingEdit');




Route::get('/', 'FrontendController@front')->name('front');
Route::get('/product/get/review/{product}/{review}', 'FrontendController@GetReview')->name('GetReview');

Route::get('/checkout', 'CheckoutController@Checkout')->name('Checkout');

Route::get('/session/get', 'CheckoutController@Checkout_Cart')->name('Checkout_Cart');

Route::get('/api/get-state-list/{id}', 'CheckoutController@GetState')->name('GetState');

Route::get('/api/get-city-list/{city_id}', 'CheckoutController@GetCity')->name('GetCity');

Route::post('/payment', 'PaymentController@payment')->name('payment');

Route::get('/product/{id}', 'FrontendController@SingleProduct')->name('SingleProduct');


Route::get('/contact', 'TestController@contact');
Auth::routes(['verify' => true]);

// Home
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/home', 'HomeController@index')->name('home');

// About
Route::get('/about', 'FrontendController@About')->name('About');

// Contact
Route::get('/contact', 'FrontendController@Contact')->name('Contact');

// Message
Route::post('/message', 'FrontendController@Message')->name('Message');
Route::get('/all-message', 'HomeController@AllMessage')->name('AllMessage');
Route::get('/delete-message/{id}', 'HomeController@DeleteMessage')->name('DeleteMessage');


// Category
Route::get('/category-list', 'CategoryController@CategoryList')->name('CategoryList');

Route::get('/category-add', 'CategoryController@CategoryAdd')->name('CategoryAdd');

Route::post('/category-post', 'CategoryController@CategoryPost')->name('CategoryPost');


Route::get('/category/delete/{id}', 'CategoryController@CategoryDelete')->name('CategoryDelete');

Route::post('/selected/category/delete', 'CategoryController@SelectedCategoryDelete')->name('SelectedCategoryDelete');


Route::get('/delete-restore', 'CategoryDeleteRestoreController@CategoryDeleteRestore')->name('CategoryDeleteRestore');

Route::get('/category/restore/{id}', 'CategoryController@CategoryRestore')->name('CategoryRestore');

Route::get('/category/permanent/{id}', 'CategoryController@PermanentDelete')->name('PermanentDelete');

Route::get('/category/edit/{id}', 'CategoryController@CategoryEdit')->name('CategoryEdit');

// update route
Route::post('/category-update', 'CategoryController@CategoryUpdate')->name('CategoryUpdate');

Route::get('/subcategory-view', 'SubCategoryController@SubCategoryView')->name('SubCategoryView');

Route::get('/subcategory-from', 'SubCategoryController@SubCategoryFrom')->name('SubCategoryFrom');

Route::post('/subcategory-post', 'SubCategoryController@SubCategoryPost')->name('SubCategoryPost');

Route::get('/subcategory-edit/{scat_id}', 'SubCategoryController@SubCategoryEdit')->name('SubCategoryEdit');

Route::post('/subcategory-update', 'SubCategoryController@SubCategoryUpdate')->name('SubCategoryUpdate');

//User's

Route::get('users', 'HomeController@users')->name('users');

Route::get('users/edit/{id}', 'HomeController@UsersEdit')->name('UsersEdit');

Route::post('users/update', 'HomeController@UsersUpdate')->name('UsersUpdate');


Route::get('products', 'ProductController@products')->name('products');

Route::get('orders', 'HomeController@orders')->name('orders');

Route::get('orders/excel/download', 'HomeController@ExcelDownload')->name('ExcelDownload');

Route::get('orders/pdf/download', 'HomeController@PDFDownload')->name('PDFDownload');

Route::get('orders/selected/date/excel/download', 'HomeController@SelectedDateExcelDownload')->name('SelectedDateExcelDownload');

Route::post('orders/excel/import', 'HomeController@import')->name('ExcelImport');


//Product 
Route::get('add/products/add', 'ProductController@ProductAdd')->name('ProductAdd');

Route::get('products/edit/{id}', 'ProductController@ProductEdit')->name('ProductEdit');

Route::get('/products/image/edit/{id}', 'ProductController@ProductImageEdit')->name('ProductImageEdit');

Route::post('products/update', 'ProductController@ProductUpdate')->name('ProductUpdate');


Route::get('products/delete/{id}', 'ProductController@ProductDelete')->name('ProductDelete');



Route::post('products-store', 'ProductController@ProductStore')->name('ProductStore');

Route::get('category/ajax/{id}', 'ProductController@CategoryAjax')->name('CategoryAjax');

Route::get('gallery-image-delete/{id}', 'ProductController@ImageGalleryDelete')->name('ImageGalleryDelete');

Route::post('products/image/update', 'ProductController@MultiImageUpdate')->name('MultiImageUpdate');

Route::get('product/get/size/{color}/{product}', 'FrontendController@GetSize')->name('GetSize');


//Product Review

Route::post('/products/reviews', 'HomeController@UserReview')->name('UserReview');



//Cart Page

Route::post('add-to-cart', 'CartController@AddToCart')->name('AddToCart');

Route::get('cart', 'CartController@Cart')->name('Cart');
Route::get('cart/{code}', 'CartController@Cart')->name('CouponValue');
Route::get('cart-product-delete/{id}', 'CartController@CartProductDelete')->name('CartProductDelete');


//Shop Page

Route::get('/shop', 'FrontendController@Shop')->name('Shop');

// Wish List

Route::get('/wish', 'WishController@WishList')->name('WishList');
Route::get('/wish-add/{id}/{category_id}/{subcategory_id}/{brand_id}', 'WishController@WishAdd')->name('WishAdd');
Route::get('wish-product-delete/{id}', 'WishController@WishProductDelete')->name('WishProductDelete');
Route::post('wish-product-update', 'WishController@WishProductUpdate')->name('WishProductUpdate');


//Role Management

Route::post('role-add-to-permission', 'RoleController@RoleAddToPermission')->name('RoleAddToPermission');
Route::post('role-add-to-user', 'RoleController@RoleAddToUser')->name('RoleAddToUser');
Route::get('change-permission-to-user/{id}', 'RoleController@ChangePermissionToUser')->name('ChangePermissionToUser');
Route::post('change-permission', 'RoleController@ChangePermission')->name('ChangePermission');


//Social Login Github  LoginWithGoogle
Route::get('login-with-github', 'SocialController@LoginWithGithub')->name('LoginWithGithub');
Route::get('callback-url', 'SocialController@GithubCallback')->name('GithubCallBack');

//Social Login Google
Route::get('login-with-google', 'SocialController@LoginWithGoogle')->name('LoginWithGoogle');
Route::get('callback-url', 'SocialController@GoogleCallBack')->name('GoogleCallBack');

Route::post('/comments', 'HomeController@Comments')->name('Comments');







//Blog Page


Route::middleware('auth')->prefix('admin')->group(function(){
    
    
    Route::resource('blog', 'BlogController');

    
    Route::get('role-manager', 'RoleController@Role')->name('Role');

});




Route::post('blog-update', 'BlogController@Blogupdate')->name('Blogupdate');
Route::get('blog-destroy/{id}', 'HomeController@destroy')->name('destroy');



Route::get('/blogs', 'FrontendController@Blogs')->name('Blogs');
Route::get('/{id}', 'FrontendController@SingleBlog')->name('SingleBlog');





Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});




//Language Part

Route::get('/{locale}', function ($locale) {
    if (! in_array($locale, ['en', 'es'])) {
        abort(400);
    }

    App::setLocale($locale);

    return back();
})->name('lang');

