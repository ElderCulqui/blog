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

Auth::routes();

Route::get('/', 'PagesController@index')->name('home');
Route::get('blog/{post}','PostsController@show')->name('blog.show');

Route::middleware('auth')
     ->namespace('Admin')
     ->as('admin.')
     ->prefix('admin')
     ->group( function () {
            Route::get('/','AdminController@index');
            Route::resource('posts','PostsController');
            Route::post('posts/{post}/photos', 'PhotosController@store')->name('admin.posts.photos.store');
});

