<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\KurirController;

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
Route::post('seller',[AuthController::class,'rSeller']);
Route::post('kurir',[AuthController::class,'rKurir']);


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
    Route::get('produk/{id}',[SellerController::class,'index']);
    Route::post('produk',[SellerController::class,'create']);
    Route::post('produk/{id}',[SellerController::class,'update']);
    Route::delete('produk/{id}',[SellerController::class,'destroy']);

    // produk aktif dan ga aktif
    Route::post('aktif/{id}',[SellerController::class,'aktifProduk']);
    Route::post('nonAktif/{id}',[SellerController::class,'nonAktifProduk']);

    // produk buka dan tutup
    Route::post('buka/{id}',[SellerController::class,'buka']);
    Route::post('tutup/{id}',[SellerController::class,'tutup']);

});

Route::middleware(['user.api'])->prefix('user')->group(function(){

    // lihat dan pesen produk
    // nampilin toko buka
    Route::get('toko',[UserController::class,'toko']);
    // nampilin produk aktif
    Route::get('produkToko/{id}',[UserController::class,'produkToko']);

    // dunia per keranjangan
    // crd keranjang
    Route::post('keranjang/{id}',[UserController::class,'keranjang']);
    Route::get('keranjang/{id}',[UserController::class,'showkeranjang']);
    Route::delete('keranjang/{id}',[UserController::class,'destroy']);
    
    // lihat total harga di keranjang
    Route::get('total/{id}',[UserController::class,'total']);

    // checkout produk dari keranjang
    Route::post('chekout',[UserController::class,'checkout']);

    // lihat data pesanan yang udah di checkout
    Route::get('pesanan/{id}',[UserController::class,'pesanan']);
    
    // klo barang sampe ubah status perjalanan ke selesai
    Route::post('selesai/{id}',[UserController::class,'selesai']);

    // user memberikan masukan
    Route::post('feedback',[UserController::class,'feedback']);

});

Route::middleware(['kurir.api'])->prefix('kurir')->group(function(){
    
    // kurir ubah status proses ke perjalanan
    Route::post('ambil/{id}',[KurirController::class,'ambilPesanan']);
    
    // kurir lihat detail produk yang dipesen user yg status proses
    Route::get('pesanan',[KurirController::class,'pesanan']);

    // lihat data pesanan yang di book kurir
    Route::get('ambil/{id}',[KurirController::class,'ambil']);   
 
});

