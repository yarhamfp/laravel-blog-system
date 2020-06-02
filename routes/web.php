<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', 'HomeController@index')->name('home');
Route::get('/post/{slug}', 'HomeController@blogpost')->name('blogpost');
Route::get('/category', 'HomeController@category')->name('category.show');
Route::get('/category/{slug}', 'HomeController@categoryview')->name('post.category');
Route::get('/postbytag/{slug}', 'HomeController@tagview')->name('post.tag');
Route::post('/subscriber', 'SubcriberController@store')->name('subscriber.store');


Route::group(['as' => 'admin.', 'prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['auth', 'admin']], function () {
    Route::get('/', 'DashboardController@index')->name('dashboard');
    Route::resource('tag', 'TagController');
    Route::resource('category', 'CategoryController');
    Route::resource('post', 'PostController');
    Route::resource('user', 'UserController');
    Route::post('/user/{id}/edit', 'UserController@role')->name('role');
    Route::resource('subcriber', 'SubcriberController');
    Route::get('/user/{id}/profile', 'ProfileController@profile')->name('profile');
    Route::post('/user/{id}/profile', 'ProfileController@update')->name('profile.update');
    Route::put('/reset-password', 'ProfileController@password')->name('reset-password');

    Route::get('pending/post', 'PostController@pending')->name('post.pending');
    Route::put('/post/{id}/approve', 'PostController@approval')->name('post.approve');
});

Route::group(['as' => 'author.', 'prefix' => 'author', 'namespace' => 'Author', 'middleware' => ['auth', 'author']], function () {
    Route::get('/', 'DashboardController@index')->name('dashboard');
    Route::resource('category', 'CategoryController');
    Route::resource('post', 'PostController');
    Route::get('pending/post', 'PostController@pending')->name('post.pending');
    Route::get('/user/{username}/profile', 'ProfileController@profile')->name('profile');
    Route::post('/user/{id}/profile', 'ProfileController@update')->name('profile.update');
    Route::put('/reset-password', 'ProfileController@password')->name('reset-password');
});

Auth::routes();
