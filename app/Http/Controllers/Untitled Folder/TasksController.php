<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Performers;
use App\Tasks;
use App\Rounds;
use App\Modems;

use DB;

class tasksController extends Controller
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
			$tasks = Tasks::paginate(10);
		} else {
			$tasks = Tasks::where('name', 'LIKE', '%'.$filter.'%')
				->orWhere('comment', 'LIKE', '%'.$filter.'%')
				->paginate(10);
		}

		return view('tasks.index')
				->with('tasks', 	$tasks)
				->with('filter', 	$filter)
				;
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$modems = Modems::all();
		$rounds = Rounds::all();
		return view('tasks.create')
				->with('rounds', 			$rounds)
				->with('modems', 			$modems)
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
		dd($request->all());
		$task = Tasks::create($request->all());
		DB::table('spams')
            ->where('round_id', $request->round_id)
            ->where('task_id', NULL)
            ->take($request->count)
            ->update(['task_id' => $task->id, 'modem_id' => $request->modem_id]);
		return redirect('tasks');
	}



	public function createAndStoreFromRound(Request $request)
	{
		$task = Tasks::create($request->all());
		DB::table('spams')
            ->where('round_id', $request->round_id)
            ->where('task_id', NULL)
            ->take($request->count)
            ->update(['task_id' => $task->id, 'modem_id' => $request->modem_id]);
		return redirect('tasks');
	}



	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		$task 	= Tasks::findOrFail($id);
		$round	= Rounds::findOrFail($task->round_id);
		$modem 	= Modems::findOrFail($task->modem_id);

		return view('tasks.show')
				->with('task', 			$task)
				->with('round', 		$round)
				->with('modem', 		$modem)
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
		$task 	= Tasks::findOrFail($id);
		$modems = Modems::all();
		$rounds = Rounds::all();
		// $performers 	= Performers::lists('name', 'id');
		// $performersIds	= $group->performers->lists('id')->toArray();

		return view('tasks.edit')
				->with('task',				$task)
				->with('modems',			$modems)
				->with('rounds',			$rounds)
				// ->with('performers',		$performers)
				// ->with('performersIds', 	$performersIds)
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

		$task = Tasks::findOrFail($id);
		// if ( !is_null($request->input('performers')) ) {
		// 	$task->performers()->sync($request->input('performers'));
		// } else {
		// 	$task->performers()->detach();
		// }

		$task->update($request->all());
		//return back();
		return redirect()->action('TasksController@show', [$id]);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		$performer = Tasks::findOrFail($id);
		$performer->delete();
		return redirect()->action('TasksController@index');
	}
}
