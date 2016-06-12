<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Numbers extends Model
{

	use SoftDeletes;

	//protected $table = 'phones';

	protected $fillable = [
		'id',
		'comment',
		'is_black',
		'operator',
	];

	protected $dates = [
		'deleted_at'
	];

	/**
	 * Performer is owned by a user;
	 */
	// public function user()
	// {
	//     //return $this->belongsTo('App\User');
	// }

	/**
	 * Performer associated with many Numbers 	 */
	public function sets()
	{
		return $this->belongsToMany('App\Sets');
	}

	// /**
	//  * Get a list of Ids of assigned groups to the Performer
	//  */
	// public function getGroupsListAttributes()
	// {
	//     //return $this->groups->lists('id');
	// }

}
