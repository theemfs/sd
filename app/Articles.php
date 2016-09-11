<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Articles extends Model
{

	use SoftDeletes;

	protected $fillable = [
		'name',
		'text',
		'user_id'
	];

}
