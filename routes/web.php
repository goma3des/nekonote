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


Route::group(['prefix' => 'admin', 'middleware'=>'auth'], function(){
  Route::get('order/create', 'Admin\OrderController@add');
  Route::post('order/create', 'Admin\OrderController@create');
  Route::get('order/edit', 'Admin\OrderController@edit');
  Route::post('order/edit', 'Admin\OrderController@update');
  Route::get('order/show', 'Admin\OrderController@show');
  Route::post('order/inquire', 'Admin\OrderController@inquire');
  Route::get('order/deleteinquiry', 'Admin\OrderController@deleteinquiry');
  Route::get('order/delete', 'Admin\OrderController@delete');
  Route::get('order/accept', 'Admin\OrderController@accept');
  Route::get('order/decline', 'Admin\OrderController@decline');
  Route::get('order/evaluate_client', 'Admin\OrderController@add_evaluate_client');
  Route::post('order/evaluate_client', 'Admin\OrderController@evaluate_client');
  Route::get('order/evaluate_enabler', 'Admin\OrderController@add_evaluate_enabler');
  Route::post('order/evaluate_enabler', 'Admin\OrderController@evaluate_enabler');
  Route::get('user/show', 'Admin\UserController@show');
  Route::get('user/edit', 'Admin\UserController@edit');
  Route::post('user/edit', 'Admin\UserController@update');
  Route::get('user/delete', 'Admin\UserController@delete');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'MainController@index');

//パスワードリセット
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');
