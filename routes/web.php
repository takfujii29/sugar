<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
//     return view('welcome');
// });

Auth::routes();

Route::get('/', 'HomeController@top');
Route::get('sugar/calc', 'UserProductsController@calc');
Route::get('/sugar/{id}', 'UserProductsController@index')->where('id', '[0-9]+')->name('sugar.index');
Route::get('/sugar/create', 'UserProductsController@showCreateForm');
Route::post('/sugar/create', 'UserProductsController@create');
Route::get('/sugar/show/{user_id}/{date}', 'UserProductsController@show');
Route::get('/sugar/edit/{id}', 'UserProductsController@showEditForm');
Route::post('/sugar/edit/{id}', 'UserProductsController@edit');
Route::get('/sugar/delete/{id}', 'UserProductsController@delete');

Route::get('/home', 'HomeController@index')->name('home');
