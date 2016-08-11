<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Numbers;
use App\Sets;

use DB;

class SetsController extends Controller
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
			$sets = Sets::orderBy('name', 'asc')
				->paginate(10)
				;
		} else {
			$sets = Sets::where('name', 'LIKE', '%'.$filter.'%')
				->orWhere('comment', 'LIKE', '%'.$filter.'%')
				->paginate(10);
		}
		return view('sets.index')
				->with('sets', 				$sets)
				->with('filter', 				$filter);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$numbers = Numbers::all();
		//$numbers = Performers::lists('name', 'id');
		return view('sets.create')
			->with('numbers', 			$numbers)
			//->with('numbersIds',		'[]')
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
		$set = Sets::create($request->all());
		$set->numbers()->attach($request->input('numbers'));
		return redirect('groups');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		$groups 		= Sets::findOrFail($id);
		$performers 	= $groups->performers;
		// dd($performers);

		$phones_list = [];
			foreach ($performers as $performer) {
				$phones = $performer->phones;
				foreach ($phones as $phone) {
					array_push($phones_list, $phone->id);
				}
			}
		$phones = array_unique($phones_list);

		return view('sets.show')
				->with('groups',			$groups)
				->with('phones',			$phones)
				->with('performers', 		$performers)
				// ->with('performersIds', 	[]')
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
		$group 			= Sets::findOrFail($id);
		$performers 	= Performers::lists('name', 'id');
		$performersIds	= $group->performers->lists('id')->toArray();

		return view('sets.edit')
				->with('group',				$group)
				->with('performers',		$performers)
				->with('performersIds', 	$performersIds);
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

		$group = Sets::findOrFail($id);
		if ( !is_null($request->input('performers')) ) {
			$group->performers()->sync($request->input('performers'));
		} else {
			$group->performers()->detach();
		}

		$group->update($request->all());
		//return back();
		return redirect()->action('SetsController@show', [$id]);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		$performer = Sets::findOrFail($id);
		$performer->delete();
		return redirect()->action('SetsController@index');
	}
}
