<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::namespace('Api')->name('api.')->group(function() {

	// 图片验证码
	Route::middleware('throttle:60,1')->get('captchas','CaptchasController@store')->name('captchas.store');

	//后端接口
	Route::prefix('admin')->name('admin.')->group(function(){
		// 登录
		Route::post('/authorization','AdminsController@store')->name('authorizations.store');
		// 刷新Token
		Route::put('/authorization/current', 'AdminsController@update')->name('authorizations.update');
		// 删除Token
		Route::delete('/authorization/current','AdminsController@destroy')->name('authorizations.destroy');

		// 登录后可以访问的接口
		Route::middleware('auth:admin')->group(function() {
			// 当前登录管理员信息
			Route::get('/user','AdminsController@me');
			// 获取后台菜单列表
			Route::resource('menus', 'MenusController');
		});

	});

	//前端接口


	//回退路由
	Route::fallback(function () {
		return response()->json(['message' => '404 请检查访问地址或请求方式是否正确'])->setStatusCode(404);
	});

});

