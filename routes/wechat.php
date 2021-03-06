<?php

/*
|--------------------------------------------------------------------------
| Wechat Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::match(['get', 'post'], 'serve/{authorizer_appid}', 'WechatController@serve');
Route::match(['get', 'post'], 'auth', 'WechatController@auth');