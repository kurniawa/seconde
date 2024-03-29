<?php

use App\Http\Controllers\ArtisanController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/test', function () {
    return view('test');
});

Route::controller(HomeController::class)->group(function(){
    Route::get('/','home')->name('home');
});

Route::controller(AuthController::class)->group(function(){
    Route::get('/login','login')->name('login');
    Route::post('/login','authenticate')->name('authenticate');
    Route::post('/logout','logout')->name('logout');
    Route::get('/register','register')->name('register');
    Route::post('/register','register_new')->name('register_new');
});

Route::controller(ItemController::class)->group(function(){
    Route::get('/items/add','create')->name('items.create')->middleware('auth');
    Route::post('/items/add','store')->name('items.store');
    Route::get('/items/{item}/show','show')->name('items.show');
    Route::get('/items/{item}/edit','edit')->name('items.edit');
    Route::post('/items/{item}/update','update')->name('items.update');
    Route::post('/items/{item}/delete','delete')->name('items.delete');
    Route::post('/items/{item}/{item_photo}/delete_photo','delete_photo')->name('items.delete_photo');
    Route::post('/items/{item}/add_photo','add_photo')->name('items.add_photo');
    Route::post('/items/{item}/mau','mau')->name('items.mau');
    Route::post('/items/{item}/{peminat_item}/hapus_peminat','hapus_peminat')->name('items.hapus_peminat');
});

Route::controller(UserController::class)->group(function(){
    Route::get('/users/{user}/list_of_items','list_of_items')->name('users.list_of_items')->middleware('auth');
});

Route::controller(ArtisanController::class)->group(function(){
    Route::get('/artisans','index')->name('artisans.index')->middleware('auth');
    Route::post('/artisans/migrate_fresh_seed','migrate_fresh_seed')->name('artisans.migrate_fresh_seed')->middleware('auth');
    Route::post('/artisans/symbolic_link','symbolic_link')->name('artisans.symbolic_link')->middleware('auth');
    Route::post('/artisans/optimize_clear','optimize_clear')->name('artisans.optimize_clear')->middleware('auth');
    Route::post('/artisans/vendor_publish_laravelPWA','vendor_publish_laravelPWA')->name('artisans.vendor_publish_laravelPWA')->middleware('auth');
});
