<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class MenuCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
//    	dd($this);
		return [
			'code' => '200',
			'msg' => 'success',
			'data' => MenuResource::collection($this),
		];
    }
}
