<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AjaxController;


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

route::get('/',[HomeController::class,'index']);
route::get('about',[HomeController::class,'about']);
route::get('testimonial',[HomeController::class,'testimonial']);
route::get('products',[HomeController::class,'products']);
route::get('blog',[HomeController::class,'blog']);
route::get('contact',[HomeController::class,'contact']);
route::get('categories',[AdminController::class,'category']);

route::post('/add_category',[AdminController::class,'add_category']);

route::get('/delete_category/{id}',[AdminController::class,'delete_category']);


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

route::get('/redirect',[HomeController::class,'redirect']);

route::post('/logout',[LogoutController::class,'destroy'])->name('logout') ;

 Route::get('/create', [AjaxController::class, 'create'])->name('create');


// Admin
 route::get('/view_product',[AdminController::class,'view_product']);

route::post('/add_product',[AdminController::class,'add_product']);
route::get('/pending_order',[AdminController::class,'pending_order']);
route::get('/delivered_orders',[AdminController::class,'delivered_orders']);

route::get('/delivered_order/{id}',[AdminController::class,'delivered_order']);
route::get('/admin_dashboard',[AdminController::class,'admin_dashboard']);

route::get('/search',[AdminController::class,'search']);





 route::get('/show_product',[AdminController::class,'show_product']);

route::get('/delete_product/{id}',[AdminController::class,'delete_product']);

route::get('/edit_product/{id}',[AdminController::class,'edit_product']);

route::post('/update_product_confirm/{id}',[AdminController::class,'update_product_confirm']);

route::get('/product_details/{id}',[HomeController::class,'product_details']);




route::post('/add_cart/{id}',[HomeController::class,'add_cart']);
route::get('/show_cart',[HomeController::class,'show_cart']);
route::get('/delete_from_cart/{id}',[HomeController::class,'delete_from_cart']);

route::get('/checkout',[HomeController::class,'checkout']);
route::get('/stripe/{total_items_price}',[HomeController::class,'stripe']);


route::post('/stripe/{total_items_price}',[HomeController::class,'stripePost'])->name('stripe.post');



route::get('/fetch_cart_data',[HomeController::class,'fetch_cart_data']);

route::delete('/delete_from_cart_ajax/{id}',[HomeController::class,'delete_from_cart_ajax']);




