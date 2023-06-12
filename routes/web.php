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

//numbers routes
Route::get('/my-numbers', [NumberController::class, 'my_numbers'])->name('my-numbers');
Route::get('/purchase-numbers/{id?}', [NumberController::class, 'purchase_numbers'])->name('purchase-numbers');
Route::post('/my-numbers', [NumberController::class, 'store'])->name('my-numbers.store');
Route::get('/my-numbers/{id}', [NumberController::class, 'show'])->name('my-numbers.show');
Route::get('/my-numbers/{id}/edit', [NumberController::class, 'edit'])->name('my-numbers.edit');
Route::put('/my-numbers/{id}', [NumberController::class, 'update'])->name('my-numbers.update');
Route::delete('/my-numbers/{id}', [NumberController::class, 'destroy'])->name('my-numbers.destroy');



//countries routes
Route::get('/countries-list', [CountriesController::class, 'countries_list'])->name('countries-list');

//recharges routes
Route::get('/my-recharges', [RechargeController::class, 'my_recharges'])->name('my-recharges');





