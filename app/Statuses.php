<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Statuses extends Model
{

	use SoftDeletes;

    protected $fillable = [
		'name',
		'comment',
	];

	protected $dates = [
		'deleted_at'
	];
}
