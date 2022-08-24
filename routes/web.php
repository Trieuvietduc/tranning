<?php

use App\Http\Controllers\CompanyController;
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


Route::get('index', function () {
    return view('index');
});
Route::resource('company', CompanyController::class);

Route::get('onlyTrashed', [CompanyController::class, 'onlyTrashed'])->name('onlyTrashed');
Route::get('restore/{id}', [CompanyController::class, 'restore'])->name('restore');
Route::get('company/sort', [CompanyController::class, 'sort'])->name('sort');
