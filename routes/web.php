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

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::group(['middleware' => ['auth']],function(){

	//BOOKS
	Route::get('/books', 'BookController@index');
	Route::post('/books', 'BookController@store');

	// CATEGORIES
	Route::get('/categories', 'CategoryController@index');

	Route::post('/categories', 'CategoryController@store');

	Route::put('/categories', 'CategoryController@update');

	Route::delete('/categories/{category}', 'CategoryController@destroy');

});








