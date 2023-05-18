<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
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

Route::get('/', [LoginController::class,'index'])->name('home');
Route::post('/submit',[LoginController::class,'loginSubmit'])->name('login.submit');
Route::get('/logout', [LoginController::class, 'Logout'])->name('logout');

Route::prefix('admin')->middleware(['permission'])->group(function () {
    Route::get('/dashboard',[AdminController::class,'dashboard'])->name('dashboard');
    Route::resource('accounts',AccountController::class);
    Route::get('/accounts-search',[AccountController::class,'search'])->name('accounts.search');
    Route::get('/search-accounts',[AccountController::class,'searchAccount'])->name('search.accounts');

});