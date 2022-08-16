<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\UserController;
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
    return view('welcome');
});

Route::prefix('dashboard')->group(function () {
    // user
    // Route::prefix('user')->name('user.')->group(function () {
        Route::resource('user', UserController::class);
        Route::get('search', [UserController::class, 'search'])->name('user.search');
        Route::get('onlyTrashed', [UserController::class, 'onlyTrashed'])->name('user.onlyTrashed');
        Route::get('restore/{user}', [UserController::class, 'restore'])->name('user.restore');
    // });

    // company
    // Route::prefix('company')->name('company.')->group(function () {
        Route::resource('company', CompanyController::class);
        Route::get('onlyTrashed', [CompanyController::class, 'onlyTrashed'])->name('company.onlyTrashed');
        Route::get('restore/{company}', [CompanyController::class, 'restore'])->name('company.restore');
    // });
});
