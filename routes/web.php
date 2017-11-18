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

//关于电影管理的相关页面

Route::resource('xunleipu', 'Manage\XunleipuController');

Route::resource('movietype', 'Manage\MovietypeController');
//修改代码
Route::resource('moviemanage', 'Manage\MovielistController');
//电影影评
Route::resource('moviereview', 'Manage\MoviereviewController');


Route::resource('Xunleipudownloadlink', 'Manage\Xunleipudownloadlink');

Route::post('xunleipumovieadd', 'Manage\MovielistController@xunleipumovieadd');
Route::get('movietypelist', 'Manage\MovietypeController@getlist');
Route::get('movieregionlist', 'Manage\MovieregionController@getlist');
Route::get('movietaglist', 'Manage\MovietagController@getlist');

Route::get('getmoviecoversrc/{id}', 'Manage\MovielistController@getMovieCoversrc');
Route::post('setmoviecoversrc', 'Manage\MovielistController@setMovieCoversrc');
Route::get('sethotmovie/{id}', 'Manage\MovielistController@setHotMovie');
Route::get('getmovierecommend/{id}', 'Manage\MovielistController@getMovieRecommend');
Route::post('setmovierecommend', 'Manage\MovielistController@setMovieRecommend');


Route::get('/captcha/{tmp}', 'CaptchaController@captcha');
Route::get('/getcaptcha', 'CaptchaController@getcaptcha');


//关于页面静态化的相关操作

Route::get('indexstatic', 'Index\IndexstaticController@index');
Route::get('liststatic', 'Index\IndexstaticController@listdemo');
Route::get('detailstatic', 'Index\IndexstaticController@detaildemo');


//没有找到更好的解决方案
Route::get('oumei.html', 'Index\IndexstaticController@oumeilist');
Route::get('oumei-{id}.html', 'Index\IndexstaticController@oumeilist');
//日韩
Route::get('rihan.html', 'Index\IndexstaticController@rihanlist');
Route::get('rihan-{id}.html', 'Index\IndexstaticController@rihanlist');
//港台
Route::get('gangtai.html', 'Index\IndexstaticController@gangtailist');
Route::get('gangtai-{id}.html', 'Index\IndexstaticController@gangtailist');
//大陆电影
Route::get('dalu.html', 'Index\IndexstaticController@dalulist');
Route::get('dalu-{id}.html', 'Index\IndexstaticController@dalulist');
//经典电影
Route::get('jingdian.html', 'Index\IndexstaticController@jingdianlist');
Route::get('jingdian-{id}.html', 'Index\IndexstaticController@jingdianlist');
//电影影评
Route::get('yingping.html', 'Index\IndexstaticController@yingpinglist');
Route::get('yingping-{id}.html', 'Index\IndexstaticController@yingpinglist');
//电影分类列表
Route::get('typelist.html', 'Index\IndexstaticController@typelist');

//根据分类获取的列表
Route::get('type-{id}-{page}.html', 'Index\IndexstaticController@typemovielist');
Route::get('type-{id}.html', 'Index\IndexstaticController@typemovielist');


//电影分类列表
Route::get('taglist.html', 'Index\IndexstaticController@taglist');

//根据电影分类获取的列表
Route::get('tag-{id}-{page}.html', 'Index\IndexstaticController@tagmovielist');
Route::get('tag-{id}.html', 'Index\IndexstaticController@tagmovielist');

//电影详情页面
Route::get('movie/{id}.html', 'Index\IndexstaticController@movie');
//影评详情页面
Route::get('review/{id}.html', 'Index\IndexstaticController@review');


