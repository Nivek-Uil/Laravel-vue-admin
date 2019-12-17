<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\AuthorizationRequest;
use App\Http\Resources\AdminsResource;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Request;

class AdminsController extends Controller
{
	// 获取授权（登录）
	public function store(AuthorizationRequest $request)
	{
		if(!$request->captcha_key || empty($request->captcha_code)){
			abort(400,'请输入验证码');
		}
		$captchaData = Cache::get($request->captcha_key);
		if (!$captchaData){
			abort(400,'图片验证码已失效');
		}

		if (!hash_equals($captchaData['code'],$request->captcha_code)) {
			//验证码错误，清除缓存
			\Cache::forget($request->captcha_key);
			throw new AuthenticationException('验证码错误');
		}

		$username = $request->username;

		$credentials['account'] = $username;
		$credentials['password'] = $request->password;

		if (!$token = \Auth::guard('admin')->attempt($credentials)) {
			throw new AuthenticationException('用户名或密码错误');
		}

		return $this->respondWithToken($token);
	}

	//	更新Token
	public function update()
	{
		$token = auth('admin')->refresh();
		return $this->respondWithToken($token);
	}

	// 删除Token（退出登录）
	public function destroy()
	{
		auth('admin')->logout();
		return response(['success'],200);
	}

	protected function respondWithToken($token)
	{
		return response()->json([
			'access_token' => $token,
			'token_type' => 'Bearer',
			'expires_in' => auth('admin')->factory()->getTTL() * 60
		]);
	}

	// 获取登录用户信息
	public function me(\Illuminate\Http\Request $request)
	{
		return new AdminsResource($request->user());
	}
}
