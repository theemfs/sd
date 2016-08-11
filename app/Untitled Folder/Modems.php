<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Modems extends Model
{

	use SoftDeletes;

	protected $fillable = [
		'name',
		'comment',
		'modem_id',
		'modem_port_number',
		'modem_port_name',
		'sender',
		'login',
		'password',
	];

	protected $dates = [
		'deleted_at'
	];



	public function updateStatus()
	{
		// $all 			= DB::table('spams')->where('task_id', $this->id)->count();
		// $estimated 		= DB::table('spams')->where('task_id', $this->id)->where('status', NULL)->count();
		// $sended 		= DB::table('spams')->where('task_id', $this->id)->whereNotNull('task_id')->count();
		// $delivered 		= DB::table('spams')->where('task_id', $this->id)->where('status', 'LIKE', '1%')->count();
		// $queued 		= DB::table('spams')->where('task_id', $this->id)->where('status', 'LIKE', '3%')->count();
		// $progress 		= round( 100*$delivered / $all );

		// $modem 			= Modems::findOrFail($this->modem_id);

		// $last_update 	= Carbon::now()->toDateTimeString();
		// ##----------------------------------------------------------------------------------------------------
		// $this->status 	= serialize([
		// 	'all'			=>$all,
		// 	'estimated'		=>$estimated,
		// 	'sended'		=>$sended,
		// 	'delivered'		=>$delivered,
		// 	'queued'		=>$queued,
		// 	'progress'		=>$progress,
		// 	'modem_name'	=>$modem->name,
		// 	'last_update'	=>$last_update,
		// 	]);
		// $this->save();
	}



	public function getBalance()
	{
		$this->send('105', 'balance');
	}



	public function send($to, $text)
	{

		//get data
		// $this->validate($request, ['to' => 'required|regex:/^89\d{9}$/', 'message'=>'required|min:1|max:60']);
		//$to 	= $request->to;
		$text 	= urlencode(iconv("utf-8","ucs-2be",$text));

		//create message in outbox
		$spam			= Spams::create(['to'=>$to, 'text'=>$text]);
		$spam->url_dlr	= action('SpamsController@delivery', [$spam->id]);

		//get some data one else
		$modem 		= Modems::findOrFail($this->id);
			$smsc 		= $modem->name;
			$username 	= $modem->login;
			$password 	= $modem->password;
			$gateway 	= Gateways::findOrFail($modem->gateway_id);
				$url 		= $gateway->url_send;

		// send
		$send_url 		= "$url?username=$username&password=$password&coding=2&dlr-mask=7&dlr-url=$spam->url_dlr&to=$spam->to&text=$text";
		$result 		= file_get_contents($send_url);
		$spam->status	= $result;
		$spam->save();
		return $result[0];

		//debug flash
		// session()->flash('flash_success', 'Message: '.$text.' / Username: '.$smsc.' / Status message: '.$result.' / URL: '.$url);
		//session()->flash('flash_success', 'Message to '.$to.' was sended with status message: '.$result);
		// session()->flash('to', $to);
		// return redirect()->action('PagesController@send');
		// return back();

	} // public function send(Request $request)
}


		// $gateway 	= Gateways::findOrFail(1);
		// 	$url		= $gateway->url_send;
		// $task 		= Tasks::findOrFail($id);
		// $modem 		= Modems::findOrFail($task->modem_id);
		// 	$smsc		= $modem->name;
		// 	$username 	= $modem->login;
		// 	$password 	= $modem->password;
		// $spams 		= Spams::where('task_id', $task->id)->get();

		// $round 		= Rounds::findOrFail($task->round_id);
		// $text 		= urlencode(iconv("utf-8","ucs-2be",$round->text));

		// foreach ($spams as $spam) {
		// 	$spam->url_dlr			= action('SpamsController@delivery', [$spam->id]);
		// 	$send_url 				= "$url?username=$username&password=$password&coding=2&dlr-mask=7&dlr-url=$spam->url_dlr&to=$spam->to&text=$text";
		// 	$spam->status 			= file_get_contents($send_url)[0];
		// 	$spam->update();
		// }
		// return redirect()->action('RoundsController@show', [$id]);