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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/invoice', 'InvoiceController@index');
Route::get('/invoice/add', 'InvoiceController@add');
Route::get('/invoice/detail/{id}', 'InvoiceController@detail');
Route::get('/invoice/pdf/{id}', 'InvoiceController@pdf');
Route::get('/invoice/findClient', 'InvoiceController@findClient');
Route::get('/invoice/findProduct', 'InvoiceController@findProduct');
Route::post('/invoice/save', 'InvoiceController@save');
Route::get('/usuarios', 'UserController@index')
    ->name('users.index');
Route::get('/usuarios/{user}', 'UserController@show')
    ->where('user', '[0-9]+')
    ->name('users.show');
Route::get('/usuarios/nuevo', 'UserController@create')->name('users.create');
Route::post('/usuarios', 'UserController@store');
Route::get('/usuarios/{user}/editar', 'UserController@edit')->name('users.edit');
Route::put('/usuarios/{user}', 'UserController@update');
Route::delete('/usuarios/{user}', 'UserController@destroy')->name('users.destroy');