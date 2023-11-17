<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SpecialProductController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\TransactionController;
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

Route::get('/',[HomeController::class,'index']);
Route::get('/product/{slug}',[HomeController::class,'product']);
Route::get('/author/{id}',[HomeController::class,'author']);
Route::get('/catalog',[HomeController::class,'catalog']);
Route::get('/special-catalog',[HomeController::class,'specialCatalog']);

Route::get('/login',[AuthController::class,'login'])->name('login');
Route::get('/register',[AuthController::class,'register'])->name('register');
Route::post('/register',[AuthController::class,'registered'])->name('register.post');
Route::post('/login',[AuthController::class,'authecicate']);

Route::middleware('auth')->group(function(){
    Route::get('/chart',[TransactionController::class,'chart']);
    Route::get('/chart-add',[TransactionController::class,'chartAdd']);
    Route::get('/chart-del/{id}',[TransactionController::class,'chartDel']);
    Route::get('/chart-del-all',[TransactionController::class,'chartDelAll']);
});

Route::prefix('admin')->group(function(){
    Route::get('/dashboard',[DashboardController::class,'index']);
    Route::resource('/categories', CategoriesController::class);
    Route::resource('/tags', TagController::class);
    Route::resource('products',ProductController::class);
    Route::resource('special-products',SpecialProductController::class);
});
