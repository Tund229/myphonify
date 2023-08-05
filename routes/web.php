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



Auth::routes();

Route::get('/', [HomeController::class, 'welcome'])->name('welcome');
Route::get('/privacy-terms', [HomeController::class, 'privacy_terms'])->name('privacy-terms');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/mywallet', [HomeController::class, 'mywallet'])->name('mywallet');
Route::get('/mywallet', [HomeController::class, 'mywallet'])->name('mywallet');
Route::get('/partners', [HomeController::class, 'partners'])->name('partners');

Route::get('/profile', [HomeController::class, 'profile'])->name('profile');
Route::get('/profile-update', [HomeController::class, 'profile_update'])->name('profile_update');
Route::post('/profile-update', [HomeController::class, 'update'])->name('update');
Route::get('/password-update', [HomeController::class, 'password_update'])->name('password_update');
Route::post('/password-update', [HomeController::class, 'password_updated'])->name('password_updated');
Route::get('/forgot-password', [HomeController::class, 'forgot_password'])->name('forgot_password');
Route::post('/forgot-password', [HomeController::class, 'forgoted_password'])->name('forgoted_password');

Route::get('/change-password/{id?}', [HomeController::class, 'change_password'])->name('change_password');
Route::post('/changed-password/{id}', [HomeController::class, 'changed_password'])->name('changed_password');









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
Route::post('/recharges', [RechargeController::class, 'recharge']);




Route::namespace('App\\Http\\Controllers\\Admin')->prefix('private')->name('private.')->middleware("is_admin")->group(function () {
    Route::resources([
        'users' => "UsersController", // gestion des users
        'recharges' => "RechargesController", // gestion des recharges
        'numbers' => "NumbersController", // gestion des numéros achetés
        'stats' => "StatsController", // gestion des numéros achetés
        'countries' => "CountryController", // gestion des numéros achetés
    ]);

    Route::get('countries.updateMta/{id}', 'CountryController@updateMta')->name('updateMta');
    Route::get('countries.updateState/{id}', 'CountryController@updateState')->name('updateState');
    Route::get('countries.gestion', 'CountryController@gestion')->name('gestion');
    Route::post('countries.gestion', 'CountryController@gestion_pays')->name('gestion_pays');



    Route::get('stats.location', 'StatsController@getLocation')->name('get.location');




    //users custom routes
    Route::get('users.block/{id}', 'UsersController@block')->name('users.block');
    Route::get('users.unblock/{id}', 'UsersController@unblock')->name('users.unblock');
    Route::get('users.reset_password/{id}', 'UsersController@reset_password')->name('users.reset_password');
    Route::get('users/user_recharges/{id}', 'UsersController@user_recharges')->name('users.user_recharges');
    Route::get('users/user_numbers/{id}', 'UsersController@user_numbers')->name('users.user_numbers');



    //numbers custom routes
    Route::get('numbers.block/{id}', 'NumbersController@block')->name('numbers.block');
    Route::get('numbers.unblock/{id}', 'NumbersController@unblock')->name('numbers.unblock');

    //recharges custom routes
    Route::get('recharges.block/{id}', 'RechargesController@block')->name('recharges.block');
    Route::get('recharges.unblock/{id}', 'RechargesController@unblock')->name('recharges.unblock');




});
