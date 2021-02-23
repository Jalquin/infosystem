<?php

use App\Http\Controllers\AddressTypeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\StatusController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

Route::get('/blank', function () {
    return view('blank');
})->name('blank');

Route::get('/items/edit/{id}/add', [ItemController::class, 'addAmount'])->name('items.amount.add');
Route::get('/items/edit/{id}/subtract', [ItemController::class, 'subtractAmount'])->name('items.amount.subtract');
Route::resource('/items', ItemController::class);

Route::resource('/categories', CategoryController::class);

Route::resource('/positions', PositionController::class);

Route::resource('/statuses', StatusController::class);

Route::resource('/roles', RoleController::class);

Route::resource('/address_types', AddressTypeController::class);



