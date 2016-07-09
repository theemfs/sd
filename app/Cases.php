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



	public function members()
	{
		return $this->belongsToMany('App\User', 'case_members', 'case_id');
	}



	public function performers()
	{
		return $this->belongsToMany('App\User', 'case_performers', 'case_id');
	}



	public function messages()
	{
		return $this->hasMany('App\Messages', 'message_id');
	}



	// public function files()
	// {
	// 	return $this->hasMany('App\Files', 'file_id');
	// }



}