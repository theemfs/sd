<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;
use Carbon\Carbon;
use App\Modems;

class Tasks extends Model
{

	use SoftDeletes;

	protected $fillable = [
		'name',
		'comment',
		'round_id',
		'modem_id',
		'count',
		'status'
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
	 * Performer associated with many Tasks
	 */
	// public function performers()
	// {
	// 	//return $this->belongsToMany('App\Performers')->withTimestamps();
	// }

	// /**
	//  * Get a list of Ids of assigned groups to the Performer
	//  */
	// public function getGroupsListAttributes()
	// {
	//     //return $this->groups->lists('id');
	// }
	public function updateStatus()
	{

		$start = microtime(true);

		$data = DB::select("
select
count(if (`task_id`=$this->id,1,null) ) `all`,
count(if (`task_id`=$this->id and status is null,1,null) ) `estimated`,
count(if (`task_id`=$this->id and status is not null,1,null) ) `sended`,
count(if (`task_id`=$this->id and status like '1%',1,null) ) `delivered`,
count(if (`task_id`=$this->id and status like '3%',1,null) ) `queued`
from spams
		");

		$all 			= $data[0]->all;
		$estimated 		= $data[0]->estimated;
		$sended 		= $data[0]->sended;
		$delivered 		= $data[0]->delivered;
		$queued 		= $data[0]->queued;

		$result = (microtime(true) - $start);
		dd($result);

		// $all 			= DB::table('spams')->where('task_id', $this->id)->count();
		// $estimated 		= DB::table('spams')->where('task_id', $this->id)->where('status', NULL)->count();
		// $sended 		= DB::table('spams')->where('task_id', $this->id)->whereNotNull('task_id')->count();
		// $delivered 		= DB::table('spams')->where('task_id', $this->id)->where('status', 'LIKE', '1%')->count();
		// $queued 		= DB::table('spams')->where('task_id', $this->id)->where('status', 'LIKE', '3%')->count();
		$progress 		= round( 100*$delivered / $all );

		$modem 			= Modems::findOrFail($this->modem_id);

		$last_update 	= Carbon::now()->toDateTimeString();
		##----------------------------------------------------------------------------------------------------
		$this->status 	= serialize([
			'all'			=>$all,
			'estimated'		=>$estimated,
			'sended'		=>$sended,
			'delivered'		=>$delivered,
			'queued'		=>$queued,
			'progress'		=>$progress,
			'modem_name'	=>$modem->name,
			'last_update'	=>$last_update,
			]);
		$this->save();
	}
}
