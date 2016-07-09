<?php

namespace App;

// use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

// class User extends Authenticatable

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

use Caffeinated\Shinobi\Traits\ShinobiTrait;

class User extends Model implements AuthenticatableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, CanResetPassword, ShinobiTrait;
	use SoftDeletes;

	protected $fillable = [
		'name',
		'email',
		'password',
		'title',
		'mobile',
		'telephonenumber',
		'last_login_at',
	];

	protected $hidden = [
		'password',
		'remember_token',
	];



	public function cases()
	{
		return $this->hasMany('App\Cases', 'user_id');
	}



	public function performerOf()
	{
		return $this->belongsToMany('App\Cases', 'case_performers', 'user_id', 'case_id');
	}



	public function memberOf()
	{
		return $this->belongsToMany('App\Cases', 'case_members', 'user_id', 'case_id');
	}



	public function files()
	{
		return $this->hasMany('App\Files', 'user_id', 'id');
	}



	public function messages()
	{
		return $this->hasMany('App\Messages', 'user_id', 'id');
	}



}