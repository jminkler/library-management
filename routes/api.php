<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/books', 'BookController@index');
Route::get('/books/{book}', 'BookController@show');
Route::get('/statuses/', 'StatusController@index');

Route::post('/books', 'BookController@store');
Route::post('/books/checkout', 'BookController@checkout');
Route::post('/books/checkin', 'BookController@checkin');

Route::delete('/books/{book}', 'BookController@destroy');
Route::put('/books/{book}', 'BookController@update');
Route::post('/books/{book}/authors', 'BookController@addAuthor');
Route::post('/books/{book}/descriptions', 'BookController@addDescription');

Route::delete('/books/{book}/authors/{author}', 'BookController@removeAuthor');
Route::delete('/books/{book}/descriptions/{description}', 'BookController@removeDescription');
