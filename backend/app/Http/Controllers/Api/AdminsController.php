<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\AuthorizationRequest;
use App\Http\Resources\AdminsResource;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Request;

class AdminsController extends Controller
{
	public function store(AuthorizationRequest $request)
	{
		$username = $request->username;

		$credentials['account'] = $username;
		$credentials['password'] = $request->password;

		if (!$token = \Auth::guard('admin')->attempt($credentials)) {
			throw new AuthenticationException('用户名或密码错误');
		}

		return response()->json([
			'access_token' => $token,
			'token_type' => 'Bearer',
			'expires_in' => \Auth::guard('admin')->factory()->getTTL() * 60
		])->setStatusCode(200);
	}

	public function update()
	{
		$token = auth('admin')->refresh();
		return $this->respondWithToken($token);
	}

	public function destroy()
	{
		auth('api')->logout();
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

	public function me(\Illuminate\Http\Request $request)
	{
		return new AdminsResource($request->user());
	}
}
