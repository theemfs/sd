<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use App\Http\Requests;

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



	public function case()
	{
		return $this->belongsTo('App\Cases', 'case_id');
	}



	public function user()
	{
		return $this->belongsTo('App\User', 'user_id');
	}



	public function files()
	{
		return $this->hasMany('App\Files', 'message_id')->orderBy('mimetype', 'desc');
	}



	// public function store(Request $request)
	// {
	// 	dd("test");
	// }



}