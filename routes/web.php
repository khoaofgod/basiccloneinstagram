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

Auth::routes();

/*
 * instagram simple clone
 * Khoa. Bui
 * Play around with Laravel
 */
// latest post

Route::get('/', 'PostsController@index')->name("posts.index");

/*
 * User Profiles
 */
Route::get('/profile', 'ProfilesController@userprofile')->name('profiles.userprofile');
Route::get('/profile/{user}', 'ProfilesController@index')->name('profiles.show')->withoutMiddleware(['auth']);
Route::get('/account', 'ProfilesController@edit')->name('profiles.edit');
Route::patch('/account', 'ProfilesController@update')->name('profiles.update');
/*
 * Networks of Followers
*
 */
Route::post('follow/{user}', 'NetworksController@store')->name("networks.store");
/*
 * Posts
 */
// user auth
Route::get('/p/create', 'PostsController@create')->name('posts.create');
Route::post('/p', 'PostsController@store')->name('posts.store');
// guest allowed
Route::get('/p/{id}-{caption}', 'PostsController@show')->name('posts.show')->withoutMiddleware(['auth']);

