<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

// use App\Performers;
use App\Rounds;
use App\Sets;
use App\Gateways;
use App\Modems;
use App\Spams;
use App\Tasks;

use DB;

class RoundsController extends Controller
{

	public function __construct()
	{
		//$this->middleware('auth');
	}



	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request)
	{
		// filered version
		$filter = trim($request->input('filter'));
		if (strlen($filter)==0) {
			$rounds = Rounds::orderBy('id', 'desc')->paginate(10);
		} else {
			$rounds = Rounds::where('name', 'LIKE', '%'.$filter.'%')
				->orWhere('comment', 'LIKE', '%'.$filter.'%')
				->orderBy('created_at', 'desc')
				->paginate(10)
				;
		}
		return view('rounds.index')
				->with('rounds', 			$rounds)
				->with('filter', 			$filter);
	}



	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		// $groups 	= Groups::lists('name', 'id');
		return view('rounds.create')
				// ->with('groups',			$groups)
				// ->with('groupsIds', 		'[]')
			;
	}



	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		$this->validate($request, ['name' => 'required', 'text' => 'required']);
		$round = Rounds::create($request->all());
		for ($i=0; $i<1; $i++) {
			$test = DB::statement( "INSERT INTO spams (`to`, `round_id`) SELECT `id`,$round->id FROM numbers WHERE deleted_at IS NULL ORDER BY RAND()" );
		}

		return redirect()->action('RoundsController@show', [$round->id]);
	}



	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		$modems = Modems::all();
		$rounds = Rounds::findOrFail($id);
		$rounds->updateStatus();
		$status = unserialize($rounds->status);

		$tasks = Tasks::where('round_id', $id)->orderBy('id', 'desc')->get();

		foreach ($tasks as $task) {
			$task->updateStatus();
		}

		return view('rounds.show')
				->with('rounds',		$rounds)
				->with('status',		$status)
				->with('modems', 		$modems)
				->with('tasks', 		$tasks)
			;
	}



	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{

		$rounds 			= Rounds::findOrFail($id);
		// $sets 				= Sets::lists('name', 'id');
		// $setsIds			= $rounds->groups->lists('id')->toArray();
		return view('rounds.edit')
				->with('rounds',			$rounds)
				// ->with('groups',			$groups)
				// ->with('setsIds', 		$setsIds)
				;
	}



	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		// dd($request->request);
		$this->validate($request, ['name' => 'required', 'text' => 'required']);
		// $request->merge(['start' => $request->has('start')]); // start checkbox
		$round = Rounds::findOrFail($id);
		// if ( !is_null($request->input('sets')) ) {
		// 	$round->sets()->sync($request->input('sets'));
		// } else {
		// 	$round->sets()->detach();
		// }
		$round->update($request->all());
		// if ($request->start) {
		// 	// $this->roundsStart($id);
		// 	return redirect()->action('GatewaysController@send', [$id]);
		// }
		return redirect()->action('RoundsController@show', [$id]);
	}



	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		$performer = Rounds::findOrFail($id);
		$performer->delete();
		return redirect()->action('RoundsController@index');
	}



	/**
	 * Return unique array of phones of rounds (summ of phones owned by performers selected groups)
	 * @param  int  $id
	 * @return array App\Phones
	 */
	public function getUniquePhones($id)
	{
		$rounds 		= Rounds::findOrFail($id);
		$groups 		= $rounds->groups;

		$phones_list = [];
		foreach ($groups as $group) {
			$performers = $group->performers;
			foreach ($performers as $performer) {
				$phones = $performer->phones;
				foreach ($phones as $phone) {
					array_push($phones_list, $phone->id);
				}
			}
		}
		$phones = array_unique($phones_list);

		return $phones;
	}



	public function batchSend($id)
	{
		$gateway 	= Gateways::findOrFail(1);
			$url		= $gateway->url_send;
		$task 		= Tasks::findOrFail($id);
		$modem 		= Modems::findOrFail($task->modem_id);
			$smsc		= $modem->name;
			$username 	= $modem->login;
			$password 	= $modem->password;
		$spams 		= Spams::where('task_id', $task->id)->get();

		$round 		= Rounds::findOrFail($task->round_id);
		$text 		= urlencode(iconv("utf-8","ucs-2be",$round->text));

		foreach ($spams as $spam) {
			$spam->url_dlr			= action('SpamsController@delivery', [$spam->id]);
			$send_url 				= "$url?username=$username&password=$password&coding=2&dlr-mask=7&dlr-url=$spam->url_dlr&to=$spam->to&text=$text";
			$spam->status 			= file_get_contents($send_url)[0];
			$spam->update();
		}
		return redirect()->action('RoundsController@show', [$id]);
	}



	public function task(Request $request, $id)
	{
		$estimated = DB::table('spams')->where('round_id', $id)->where('status', NULL)->count();
		$validation_string = "required|numeric|between:1,$estimated";
		$this->validate($request, ['count' => $validation_string]);

		$task = Tasks::create($request->all());
		$round = Rounds::findOrFail($id);
		DB::table('spams')
			->where('round_id', $request->round_id)
			->where('task_id', NULL)
			->take($request->count)
			->update(['task_id' => $task->id, 'modem_id' => $request->modem_id, 'text' => $round->text]);
		$this->batchSend($task->id);
		return redirect()->action('RoundsController@show', [$id]);
	}



}
