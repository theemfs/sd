<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sets extends Model
{

	use SoftDeletes;

	protected $fillable = [
		'name',
		'comment',
		'phone'
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
	 * Performer associated with many Types
	 */
	// public function performers()
	// {
	// 	return $this->belongsToMany('App\Performers')->withTimestamps();
	// }

	public function rounds()
	{
		return $this->belongsToMany('App\Rounds')->withTimestamps();
	}

	// /**
	//  * Get a list of Ids of assigned groups to the Performer
	//  */
	// public function getGroupsListAttributes()
	// {
	//     //return $this->groups->lists('id');
	// }

}
