<?php
use App\Events\TestQueueEvent;
use App\Jobs\Test;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
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

Route::middleware(['device:Customer'])->group(function () {
	Route::get('/', 'Customer\HomeController@index');//首页
    Route::get('/novel_type_list','Customer\NovelTypeController@novelTypeList');//小说类型列表
    Route::get('/novel_list', 'Customer\NovelController@novelList');//小说列表
    Route::get('/novel_detail', 'Customer\NovelController@novelDetail');//小说详情
    Route::get('/novel_chapter', 'Customer\NovelChapterController@novelChapter');//小说章节内容


    Route::get('/goods', 'Customer\GoodsController@index');//淘宝商品信息
});