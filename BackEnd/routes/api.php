<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



Route::post('login',[AuthController::class,'login']); 
Route::post('register',[AuthController::class,'register']);
Route::post('registerDriver',[AuthController::class,'registerDriver']);
Route::post('loginDriver',[AuthController::class,'loginDriver']);
Route::get('storeId/{id}',[StoreController::class,'getStoreId']);
Route::get('product/{id}',[UserController::class,'productByStore']);
Route::get('store',[UserController::class,'getStore']);
Route::get('getOrderDetail/{transaction}',[ProductController::class,'getOrderDetails']);


    // nampilin produk aktif
Route::get('product/{id}',[UserController::class,'productByStore']);


//user Middleware

//Seller Middleware







Route::middleware(['admin.api'])->prefix('admin')->group(function(){

    // admin register tapi udah g kepake
    Route::post('regis',[AdminController::class,'regis']);

    // admin control user
    // admin bisa lihat semua user dan hapus tapi udh g kepake
    Route::get('user',[AdminController::class,'showUser']);
    Route::delete('user/{id}',[AdminController::class,'userdelete']);

    // admin liat feedback user
    Route::get('feedback',[AdminController::class,'showFeedback']);
});

Route::middleware(['seller.api'])->prefix('seller')->group(function(){

    //crud produk
    Route::post('createProduct',[StoreController::class,'createProduct']);
    Route::post('updateProduct/{id}',[StoreController::class,'updateProduct']);
    Route::delete('deleteProduct/{id}',[StoreController::class,'deleteProduct']);
    Route::get('productStore',[StoreController::class,'productForStore']);
    
    Route::get('orderStore',[StoreController::class,'orderStore']);
    Route::put('takeOrder/{id}',[StoreController::class,'takeOrder']);
    
    
    

    // produk aktif dan ga aktif
    Route::put('publishProduct/{id}',[StoreController::class,'publishProduct']);
    Route::put('unpublishProduct/{id}',[StoreController::class,'unpublishProduct']);


    // produk buka dan tutup
    Route::post('openStore/{id}',[StoreController::class,'openStore']);
    Route::post('closeStore/{id}',[StoreController::class,'closeStore']);

});

Route::middleware(['user.api'])->prefix('user')->group(function(){

    // dunia per keranjangan
    // crd keranjang
    Route::post('addCart/{id}',[UserController::class,'addCart']);
    Route::post('reduceCart/{id}',[UserController::class, 'reduceCart']);
    Route::get('showCart',[UserController::class,'showCart']);
    Route::delete('deleteCart/{id}',[UserController::class,'deleteCart']);
    
    // lihat total harga di keranjang
    // Route::get('total/{id}',[UserController::class,'total']);

    // Tambah Alamat
    Route::post('addAddress',[UserController::class,'addAddress']);
    Route::put('editAddress/{id}',[UserController::class,'editAddress']);
    Route::get('getAddressActive',[UserController::class,'getAddressActive']);
    Route::get('getAddress',[UserController::class,'getAddress']);


    // checkout produk dari keranjang
    Route::post('addOrder',[UserController::class,'addOrder']);

    // lihat data pesanan yang udah di checkout
    Route::get('showOrder',[UserController::class,'showOrder']);
    Route::get('orderDetail/{id}',[UserController::class,'orderDetail']);
    
    
    Route::post('registerStore',[UserController::class,'registerStore']);

    // Rubah Role
    Route::post('changeStore',[UserController::class,'changeStore']);

    
    // user memberikan masukan
    Route::post('feedback',[UserController::class,'feedback']);

});

Route::middleware(['driver.api'])->prefix('driver')->group(function(){
    Route::get('history',[DriverController::class,'history']);
    Route::get('getOrderReady',[DriverController::class,'getOrderReady']);
    Route::put('takeOrderDriver/{id}',[DriverController::class,'takeOrderDriver']);
    
    // kurir ubah status proses ke perjalanan
    Route::post('ambil/{id}',[KurirController::class,'ambilPesanan']);
    
    // kurir lihat detail produk yang dipesen user yg status proses
    Route::get('pesanan',[KurirController::class,'pesanan']);   
 
});

