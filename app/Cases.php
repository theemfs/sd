<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cases extends Model
{

	use SoftDeletes;

	//protected $table = 'phones';

	protected $fillable = [
		'id',
		'comment',
		'name',
		'text',
		'user_id',
	];

	protected $dates = [
		'deleted_at'
	];

	

	public function user()
	{
		return $this->belongsTo('App\User', 'user_id');
	}



	// public function spectators()
	// {
	// 	return $this->belongsToMany('App\User', 'user_id');
	// }



	public function messages()
	{
		return $this->hasMany('App\Messages', 'message_id');
	}



	// public function files()
	// {
	// 	return $this->hasMany('App\Files', 'file_id');
	// }



}