<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Admin extends Authenticatable implements JWTSubject
{
	protected $fillable = [
		'account','password','avatar','status'
	];

	protected $hidden = [
		'password','deleted_at','updated_at'
	];
    //
	//
	/**
	 * @inheritDoc
	 */
	public function getJWTIdentifier()
	{
		// TODO: Implement getJWTIdentifier() method.
		return $this->getKey();
	}

	/**
	 * @inheritDoc
	 */
	public function getJWTCustomClaims()
	{
		// TODO: Implement getJWTCustomClaims() method.
		return [];
	}
}
