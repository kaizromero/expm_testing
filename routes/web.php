<?php

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

// Route::get('/', function () {
//     return view('home.index');
// });
Route::get('/', 'HomeController@index')->name('home');
Auth::routes();
Route::middleware(['auth'])->group(function () {
    
    // Route::get('/register', 'HomeController@index')->name('home');
    Route::resource('current', 'CurrentController');
    Route::resource('expenses', 'ExpenseController');
    Route::resource('category', 'CategoryController');
    Route::resource('work', 'WorkController');
    Route::resource('earning', 'EarningController');
    Route::resource('user', 'UserController');
    Route::post('multi', 'MultiExpenseController@store')->name('multi.store');
});