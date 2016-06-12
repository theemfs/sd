<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Spams extends Model
{

	use SoftDeletes;

	protected $fillable = [
		'from',
		'to',
		'text',
		'smsc',
		'status',
		'sending_id',
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
	 * Performer associated with many Messages
	 */
	// public function groups()
	// {
	// 	return $this->belongsToMany('App\Groups')->withTimestamps();
	// }

	public function rounds()
	{
		return $this->belongsTo('App\Rounds');
	}

	// /**
	//  * Get a list of Ids of assigned groups to the Performer
	//  */
	// public function getGroupsListAttributes()
	// {
	//     //return $this->groups->lists('id');
	// }

}
