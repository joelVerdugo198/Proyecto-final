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
    return view('welcome');
});

Route::get('/suma/{num1}/{num2}', 'WebController@suma'); 

/*Route::get('/suma/{num1}/{num2}', function ($num1,$num2) {

    echo "El resultado es: " . ($num1 + $num2)."<br>";
    echo "El resultado es: " . ($num1 - $num2);

})->where('num1','[0-9]+')->where('num2','[0-9]+');*/

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', 'LoanController@dashboard')->name('dashboard');


	Route::group(['middleware' => ['auth']],function(){

	//BOOKS
	Route::get('/books', 'BookController@index');

	Route::get('/books/{book}', 'BookController@show');

	Route::post('/books', 'BookController@store');
	
	Route::put('/books', 'BookController@update');

	Route::delete('/books/{book}', 'BookController@destroy');

	// CATEGORIES
	Route::get('/categories', 'CategoryController@index')->name('categories')->middleware('permission:crud categories');

	Route::post('/categories', 'CategoryController@store');

	Route::put('/categories', 'CategoryController@update');

	Route::delete('/categories/{category}', 'CategoryController@destroy');

	// LOANS
	Route::get('/loans', 'LoanController@index');

	Route::post('/loans', 'LoanController@store');

	Route::put('/loans', 'LoanController@update');

	Route::delete('/loans/{loan}', 'LoanController@destroy');

	// USERS
	Route::get('/users', 'UserController@index');

	Route::get('/users/{user}', 'UserController@show');

	Route::post('/users', 'UserController@store');

	Route::put('/users', 'UserController@update');

	Route::delete('/users/{user}', 'UserController@destroy');

});








