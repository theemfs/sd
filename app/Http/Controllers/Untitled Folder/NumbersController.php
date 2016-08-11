<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Sets;
use App\Numbers;
use App\Operators;

use DB;

class NumbersController extends Controller
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
			$numbers 	= Numbers::paginate(10);
		} else {
			$numbers 	= Numbers::where('id', 'LIKE', '%'.$filter.'%')
				->paginate(10);
		}

		return view('numbers.index')
				->with('numbers', 			$numbers)
				->with('filter', 			$filter);
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
		Numbers::create($request->all());
		return redirect()->action('NumbersController@show', [$request->id]);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		$number 			= Numbers::findOrFail($id);
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
		$number 		= Numbers::findOrFail($id);
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

		$number = Numbers::findOrFail($id);

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
		return redirect()->action('NumbersController@show', [$id]);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		$performer 		= Numbers::findOrFail($id);
		$performer->delete();
		return redirect()->action('NumbersController@index');
	}



	public function clean2(Request $request)
	{
		$operators 	= DB::table('operators')->orderBy('code', 'asc')->get();
		//$numbers 	= DB::table('numbers')->whereNull('operator')->orderBy('updated_at', 'asc')->take(100)->get();
		$numbers 	= NUmbers::whereNull('operator')->take(1000000)->get();
		$result 	= "";

		// dd($numbers);
		// dd($operators);

		foreach ($numbers as $number) {

			$i = 0;
			$j = "";

			foreach ($operators as $operator) {
				
				$from 	= intval( "8".$operator->code.$operator->from );
				$to 	= intval( "8".$operator->code.$operator->to );

				if ( intval($number->id) >= $from AND intval($number->id) <= $to) {

					$i++;
					$j = "(8" . $operator->code.$operator->from . " - 8".$operator->code.$operator->to . ")" . $operator->name;
					break;

				} else { }

			}


			// YES!
			if ($i>0) {
				$number->operator = $j;
				$number->save();
				$result = $result . "<br><strong>" . $number->id . "</strong>" . "(8".$operator->code.$operator->from . " - 8".$operator->code.$operator->to . ") = YES! " . $operator->name;
			}

			// NO!
			if ($i==0) {
				$number->comment = "removed as not a 38 region / " . $number->comment;
				$number->save();
				$number->delete();
				$result = $result . "<br><strong>" . $number->id . "</strong> = NO!";
			};

		}

		return $result;

	}
}
