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

// use Caffeinated\Shinobi\Traits\ShinobiTrait;

class User extends Model implements AuthenticatableContract,
									CanResetPasswordContract
{
	use Authenticatable, CanResetPassword;
	// use ShinobiTrait;
	use SoftDeletes;

	protected $fillable = [
		'name',
		'email',
		'password',
		'title',
		'mobile',
		'phone',
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




	public function authorOf()
	{
		return $this->hasMany('App\Cases', 'user_id')->orderBy('last_reply_at', 'desc');

	}
	public function authorOfOpen()
	{
		//dd($this->hasMany('App\Cases', 'user_id')->orderBy('last_reply_at', 'desc'));
		return $this->hasMany('App\Cases', 'user_id')->where('status_id', '<>', 5)->orderBy('last_reply_at', 'desc');
	}
	public function authorOfClosed()
	{
		return $this->hasMany('App\Cases', 'user_id')->where('status_id', 5)->orderBy('last_reply_at', 'desc');
	}
	// public function cases()
	// {
	// 	//return $this->hasMany('App\Cases', 'user_id')->orderBy('last_reply_at', 'desc');
	// 	//return $this->hasMany('App\Cases', 'user_id')->where('status_id', '<>', '5')->orderBy('last_reply_at', 'desc');
	// 	return $this->hasMany('App\Cases', 'user_id')->orderBy('last_reply_at', 'desc');
	// }



	public function performerOf()
	{
		return $this->belongsToMany('App\Cases', 'case_performers', 'user_id', 'case_id')->orderBy('last_reply_at', 'desc');;
	}
	public function performerOfOpen()
	{
		return $this->belongsToMany('App\Cases', 'case_performers', 'user_id', 'case_id')->where('status_id', '<>', 5)->orderBy('last_reply_at', 'desc');;
	}
	public function performerOfClosed()
	{
		return $this->belongsToMany('App\Cases', 'case_performers', 'user_id', 'case_id')->where('status_id', 5)->orderBy('last_reply_at', 'desc');;
	}



	public function memberOf()
	{
		return $this->belongsToMany('App\Cases', 'case_members', 'user_id', 'case_id')->orderBy('last_reply_at', 'desc');
	}
	public function memberOfOpen()
	{
		return $this->belongsToMany('App\Cases', 'case_members', 'user_id', 'case_id')->where('status_id', '<>', 5)->orderBy('last_reply_at', 'desc');
	}
	public function memberOfClosed()
	{
		return $this->belongsToMany('App\Cases', 'case_members', 'user_id', 'case_id')->where('status_id', 5)->orderBy('last_reply_at', 'desc');
	}



	public function casesAll()
	{
		$cases0 = $this->authorOf;
		$cases1 = $this->performerOf;
		$cases2 = $this->memberOf;
		return $cases0->merge($cases1)->merge($cases2)->unique();
	}
	public function casesAllOpen()
	{
		return $this->casesAll()->where('status_id', '<>', 5);
	}
	public function casesAllClosed()
	{
		return $this->casesAll()->where('status_id', 5);
	}



	public function files()
	{
		return $this->hasMany('App\Files', 'user_id', 'id');
	}



	public function messages()
	{
		return $this->hasMany('App\Messages', 'user_id', 'id');
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
		$chars = "АаБбВвГгДдЕеЁёЖжЗзИиЙйКкЛлМмНнОоПпРрСсТтУуФфХхЦцЧчШшЩщЪъЫыЬьЭэЮюЯя";
		$fio = str_word_count($this->name, 1, $chars);

		$r = "";

		if (str_word_count($this->name, 0, $chars) == 1) {
			$r = $this->name;
		}

		if (str_word_count($this->name, 0, $chars) == 2) {
			$r = $fio[0] . " " . $fio[1];
		}

		if (str_word_count($this->name, 0, $chars) == 3) {
			$r = $fio[0] . "&nbsp;" . mb_substr($fio[1],0,1) . "." . mb_substr($fio[2],0,1) . ".";
		}

		return $r;
	}





}