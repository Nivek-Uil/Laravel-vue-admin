<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AdminsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
    	return [
    		'name' => $this->account,
			'avatar' => $this->avatar,
			'status' => $this->status,
			'roles' => ['admin'],
			'introducation' => 'super_admin'
		];
//		return parent::toArray($request);
    }
}
