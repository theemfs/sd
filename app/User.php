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
		'department',
		'last_login_at',
		'is_admin',
		'can_be_performer',
		'is_active'
	];

	protected $hidden = [
		'password',
		'remember_token',
	];



	public function cases()
	{
		return $this->hasMany('App\Cases', 'user_id')->where('status_id', '<>', '5')->orderBy('last_reply_at', 'desc');
	}



	public function performerOf()
	{
		return $this->belongsToMany('App\Cases', 'case_performers', 'user_id', 'case_id')->where('status_id', '<>', '5')->orderBy('last_reply_at', 'desc');;
	}



	public function memberOf()
	{
		return $this->belongsToMany('App\Cases', 'case_members', 'user_id', 'case_id')->where('status_id', '<>', '5')->orderBy('last_reply_at', 'desc');
	}



	public function files()
	{
		return $this->hasMany('App\Files', 'user_id', 'id');
	}



	public function messages()
	{
		return $this->hasMany('App\Messages', 'user_id', 'id');
	}



	public function getAllMyCases()
	{
		$cases0 = $this->cases->toBase();
		$cases1 = $this->performerOf->toBase();
		$cases2 = $this->memberOf->toBase();

		return $cases0->merge($cases1)->merge($cases2);
	}



	public function getSurname()
	{
		$fio = explode(' ',$this->name);
		return $fio[0];
	}

	public function getName()
	{
		$fio = explode(' ',$this->name);
		return $fio[1];
	}

	public function getThirdName()
	{
		$fio = explode(' ',$this->name);
		return $fio[2];
	}

	public function getSurnameWithInitials()
	{
		$fio = explode(' ',$this->name);
		$r = "";
		$r .= array_key_exists("0", $fio) ? $fio[0] : "";
		$r .= array_key_exists("1", $fio) ? " " . mb_substr($fio[1],0,1) : "";
		$r .= array_key_exists("2", $fio) ? "." . mb_substr($fio[2],0,1) ."." : "";
		return $r;
	}





}