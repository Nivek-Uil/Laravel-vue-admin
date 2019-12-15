<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Base
{
    //使用软删除
	use SoftDeletes;

	protected $fillable = ['name','code','parent_id','icon','url','sort','type'];

	protected $hidden = [
		'deleted_at', 'updated_at',
	];

	public function childMenu()
	{
		return $this->hasMany('App\Models\Menu','parent_id','id');
	}

	public function children()
	{
		return $this->childMenu()->with('children');
	}
}
