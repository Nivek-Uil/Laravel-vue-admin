<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CaptchaRequest;
use Gregwar\Captcha\CaptchaBuilder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class CaptchasController extends BaseController
{
	public function store(CaptchaBuilder $captchaBuilder)
	{
		$key = 'captcha-'.Str::random(10);

		$captcha = $captchaBuilder->build();

		//缓存code
		\Cache::put($key,['code'=>$captcha->getPhrase()]);

		$result = [
			'captcha_key' => $key,
            'captcha_image_content' => $captcha->inline()
        ];

        return response()->json($result)->setStatusCode(201);
    }
}
