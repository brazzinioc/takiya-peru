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

Route::get('/', 'PageController@home')->name('home');
Route::get('/contribuir', 'PageController@contribute')->name('contribute');

Route::prefix('/dashboard/')->name('dashboard.')->middleware('auth')->group(function () {
    Route::resource('/musicgenres', 'MusicGenreController');
    Route::resource('/authors', 'AuthorController');
    Route::resource('/songs', 'SongController')->except(['show', 'contribute']);
});

Route::get('/songs/{slug}', 'SongController@show')->name('song.read');
Route::post('/contribuir', 'SongController@contribute')->name('song.contribute');

Auth::routes(['register' => false, 'reset' => false, 'confirm' => false ]);
