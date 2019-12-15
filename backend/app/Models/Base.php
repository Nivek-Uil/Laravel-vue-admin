<?php
/**
 * Created By PhpStorm
 * Author: Kevin
 * Date: 2019/12/15 11:36
 * Email: 863129201@qq.com
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Base extends Model
{
	use SoftDeletes;
}
