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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/profile', 'ProfileController@index')->name('profile');
Route::put('/profile', 'ProfileController@update')->name('profile.update');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/items/edit/{id}/add', 'ItemsController@addAmount')->middleware('auth')->name('items.amount.add');
Route::get('/items/edit/{id}/subtract', 'ItemsController@subtractAmount')->middleware('auth')->name('items.amount.subtract');
Route::resource('/items', ItemController::class)->middleware('auth');

Route::resource('/categories', CategoryController::class)->middleware('auth');

Route::resource('/positions', PositionController::class)->middleware('auth');

