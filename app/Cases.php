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
		'due_to',
		'status_id',
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
		return $this->belongsToMany('App\User', 'case_members', 'case_id')->orderBy('name', 'asc');
	}



	public function performers()
	{
		return $this->belongsToMany('App\User', 'case_performers', 'case_id')->orderBy('name', 'asc');
	}



	public function last_replier()
	{
		return $this->belongsTo('App\User', 'last_replier_id');
	}



	public function messages()
	{
		return $this->hasMany('App\Messages', 'message_id');
	}



	public function status()
	{
		return $this->belongsTo('App\Statuses', 'status_id');
	}



 //    public function getAllMyCases()
	// {
	// 	$case_members       = $this->belongsToMany('App\User', 'case_members', 'case_id');
	// 	$case_performers    = $this->belongsToMany('App\User', 'case_performers', 'case_id');
 //        return $case_members->merge($case_performers);
	// }



	// public function files()
	// {
	// 	return $this->hasMany('App\Files', 'file_id');
	// }



}