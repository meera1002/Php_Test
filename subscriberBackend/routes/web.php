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

Route::get('/', 'SubscriberController@index');

Route::post('destroy/{id}', 'SubscriberController@destroy');
Route::post('api/addSubscriber', array('middleware' => 'cors', 'uses' => 'SubscriberController@store'));
Route::post('sendEmail','SubscriberController@sendEmail');

