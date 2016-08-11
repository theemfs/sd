<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Operators;

use DB;

class OperatorsController extends Controller
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
			$operators 	= DB::table('operators')->orderBy('code', 'asc')->paginate(1000);
		} else {
			$operators 	= Operators::where('id', 'LIKE', '%'.$filter.'%')->paginate(100);
		}

		return view('operators.index')
				->with('operators', $operators)
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
		return view('numbers.create')
				// ->with('performers', 			$performers)
				// ->with('performersIds',			'[]')
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
		$this->validate($request, ['id' => 'unique:numbers|required|regex:/^89\d{9}$/']);
		Operators::create($request->all());
		return redirect()->action('OperatorsController@show', [$request->id]);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		$number 			= Operators::findOrFail($id);
		return view('numbers.show')
				->with('number',				$number)
				// ->with('performers', 		$performers)
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
		$number 		= Operators::findOrFail($id);
		// $sets 			= Sets::lists('name', 'id');
		// $performersIds	= $phone->performers->lists('id')->toArray();
		return view('numbers.edit')
				->with('number',				$number)
				// ->with('sets',					$sets)
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

		$number = Operators::findOrFail($id);

		// if ( !is_null($request->input('performers')) ) {
		// 	$number->performers()->associate($request->input('performers')[0]);
		// } else {
		// 	// $phone->performers()->detach();
		// }
		// if ( !is_null($request->input('performers')) ) {
		// 	$phone->performers()->sync($request->input('performers'));
		// } else {
		// 	$phone->performers()->detach();
		// }

		$number->update( $request->all() );
		return redirect()->action('OperatorsController@show', [$id]);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		$performer 		= Operators::findOrFail($id);
		$performer->delete();
		return redirect()->action('OperatorsController@index');
	}
}
