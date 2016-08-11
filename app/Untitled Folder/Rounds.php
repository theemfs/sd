<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use DB;
use Carbon\Carbon;

class Rounds extends Model
{

	use SoftDeletes;

	protected $fillable = [
		'name',
		'text',
		'start',
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
	 * Performer associated with many Rounds
	 */
	public function rounds()
	{
		return $this->belongsToMany('App\Sets')->withTimestamps();
	}

	public function spams()
	{
		return $this->hasMany('App\Spams');
	}

	/**
	 * Refresh statistics of the current round and save into status field
	 */
	public function updateStatus()
	{
		$all			= DB::table('spams')->where('round_id', $this->id)->count();
		$estimated		= DB::table('spams')->where('round_id', $this->id)->where('status', NULL)->count();
		// $prepared		= DB::table('spams')->where('round_id', $this->id)->whereNotNull('task_id')->count();
		$sended			= DB::table('spams')->where('round_id', $this->id)->whereNotNull('task_id')->count();
		$delivered		= DB::table('spams')->where('round_id', $this->id)->where('status', 'LIKE', '1%')->count();
		$queued			= DB::table('spams')->where('round_id', $this->id)->where('status', 'LIKE', '3%')->count();

		$progress_sending		= round( 100 * $sended / $all);
		$progress_delivery		= round( 100 * $delivered / $all);

		$last_update	= Carbon::now()->toDateTimeString();
		##----------------------------------------------------------------------------------------------------
		$this->status	= serialize([
			'all'					=>$all,
			'estimated'				=>$estimated,
			// 'prepared'				=>$prepared, // numbers in tasks
			'sended'				=>$sended,
			'delivered'				=>$delivered,
			'queued'				=>$queued,
			'progress_sending'		=>$progress_sending,
			'progress_delivery'		=>$progress_delivery,
			'last_update'			=>$last_update,
			]);
		$this->save();
	}

}
