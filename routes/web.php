<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NumberController;
use App\Http\Controllers\RechargeController;
use App\Http\Controllers\CountriesController;

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
    return view('welcome');
})->name('welcome');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/mywallet', [HomeController::class, 'mywallet'])->name('mywallet');
Route::get('/profile', [HomeController::class, 'profile'])->name('profile');
Route::get('/profile-update', [HomeController::class, 'profile_update'])->name('profile_update');
Route::post('/profile-update', [HomeController::class, 'update'])->name('update');

Route::get('/password-update', [HomeController::class, 'password_update'])->name('password_update');




//numbers routes
Route::get('/my-numbers', [NumberController::class, 'my_numbers'])->name('my-numbers');
Route::get('/purchase-numbers/{id?}', [NumberController::class, 'purchase_numbers'])->name('purchase-numbers');
Route::post('/temp-purchase', [NumberController::class, 'temp_purchase'])->name('temp-purchase');
Route::get('/purchase-delete/{id}', [NumberController::class, 'purchase_delete'])->name('purchase-delete');
Route::post('/purchase/{id}', [NumberController::class, 'purchase'])->name('purchase');


Route::post('/my-numbers', [NumberController::class, 'store'])->name('my-numbers.store');
Route::get('/my-numbers/{id}', [NumberController::class, 'show'])->name('my-numbers.show');
Route::get('/my-numbers/{id}/edit', [NumberController::class, 'edit'])->name('my-numbers.edit');
Route::put('/my-numbers/{id}', [NumberController::class, 'update'])->name('my-numbers.update');
Route::delete('/my-numbers/{id}', [NumberController::class, 'destroy'])->name('my-numbers.destroy');



//countries routes
Route::get('/countries-list', [CountriesController::class, 'countries_list'])->name('countries-list');

//recharges routes
Route::get('/my-recharges', [RechargeController::class, 'my_recharges'])->name('my-recharges');



Route::namespace('App\\Http\\Controllers\\Admin')->prefix('private')->name('private.')->middleware("is_admin")->group(function () {
    Route::resources([
        'users' => "UsersController", // gestion des users
        'recharges' => "RechargesController", // gestion des recharges
        'numbers' => "NumbersController", // gestion des numéros achetés
        'stats' => "StatsController", // gestion des numéros achetés
    ]);

    //users custom routes
    Route::get('users.block/{id}', 'UsersController@block')->name('users.block');
    Route::get('users.unblock/{id}', 'UsersController@unblock')->name('users.unblock');
    Route::get('users.reset_password/{id}', 'UsersController@reset_password')->name('users.reset_password');
    Route::get('users/user_recharges/{id}', 'UsersController@user_recharges')->name('users.user_recharges');
    Route::get('users/user_numbers/{id}', 'UsersController@user_numbers')->name('users.user_numbers');




});
