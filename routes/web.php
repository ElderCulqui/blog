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
Route::get('blog/{post}','PostsController@show')->name('posts.show');
Route::get('categorias/{category}','CategoriesController@show')->name('categories.show');
Route::get('tags/{tag}','TagsController@show')->name('tags.show');

Route::middleware('auth')
     ->namespace('Admin')
     ->as('admin.')
     ->prefix('admin')
     ->group( function () {
            Route::get('/','AdminController@index');
            Route::resource('posts','PostsController');
            
            Route::post('posts/{post}/photos', 'PhotosController@store')->name('posts.photos.store');
            Route::delete('photos/{photo}/', 'PhotosController@destroy')->name('photos.destroy');
});

