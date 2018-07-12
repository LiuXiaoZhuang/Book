<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    //return $request->user();
    return 'SUCCESS';
});
Route::middleware([])->group(function () {
	Route::post('/login', 'Customer\Auth\LoginController@login');
    Route::post('/info', 'Customer\HomeController@copyData');
});

Route::middleware(['login'])->group(function(){
	
});


Route::middleware(['login_token'])->group(function(){
    Route::post('/home', 'Customer\HomeController@index');//首页
    Route::post('/novel_type_list','Customer\NovelTypeController@novelTypeList');//小说类型列表
    Route::post('/novel_list', 'Customer\NovelController@novelList');//小说列表
    Route::post('/novel_detail', 'Customer\NovelController@novelDetail');//小说详情
    Route::post('/novel_chapter', 'Customer\NovelChapterController@novelChapter');//小说章节内容
	Route::post('/bookshelf', 'Customer\BookshelfController@index');//书架首页
	Route::post('/add_book', 'Customer\BookshelfController@addBook');//加入书架
    Route::post('/del_book', 'Customer\BookshelfController@delBook');//移出书架
    Route::post('/set_top', 'Customer\BookshelfController@setTop');//置顶设置
});
