<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Messages extends Model
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

	public function sendings()
	{
		return $this->belongsTo('App\Sendings');
	}

	// /**
	//  * Get a list of Ids of assigned groups to the Performer
	//  */
	// public function getGroupsListAttributes()
	// {
	//     //return $this->groups->lists('id');
	// }

}
