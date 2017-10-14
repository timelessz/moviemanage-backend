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
Route::resource('xunleipu', 'Manage\XunleipuController');
Route::resource('movietype', 'Manage\MovietypeController');
Route::resource('movie', 'Manage\MovielistController');

Route::post('xunleipumovieadd', 'Manage\MovielistController@xunleipumovieadd');
Route::get('movietypelist', 'Manage\MovietypeController@getlist');
Route::get('movieregionlist', 'Manage\MovieregionController@getlist');
Route::get('movietaglist', 'Manage\MovietagController@getlist');

Route::get('/captcha/{tmp}', 'CaptchaController@captcha');
Route::get('/getcaptcha', 'CaptchaController@getcaptcha');


Route::get('indexstatic', 'Index\IndexstaticController@index');
Route::get('liststatic', 'Index\IndexstaticController@listdemo');
Route::get('detailstatic', 'Index\IndexstaticController@detaildemo');



//没有找到更好的解决方案
Route::get('oumei.html', 'Index\IndexstaticController@oumeilist');
Route::get('oumei/{id}.html', 'Index\IndexstaticController@oumeilist');


Route::get('dalu.html', 'Index\IndexstaticController@dalulist');
Route::get('dalu/{id}.html', 'Index\IndexstaticController@dalulist');

