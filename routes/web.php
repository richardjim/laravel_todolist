<?php

use App\Http\Controllers\BooksController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthorController;


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
Route::resource('/books', BooksController::class);
Auth::routes();

Route::get('/home', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/book', [BooksController::class, 'index']);
