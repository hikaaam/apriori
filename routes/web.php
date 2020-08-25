<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', "frontendController@index");

//Resource
Route::resource("/product","frontendController");
Route::resource("/admin","backendController");
Route::resource("/admin/product","ProductController");
Route::resource("/admin/categories","CategoriesController");
Route::resource("/profile","ProfileController");
Route::resource("/history","TransactionController");
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
