<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Spams;
use App\Modems;

class SpamsController extends Controller
{
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
			$modems = Modems::paginate(10);
				if ( $modems->count() == 0 ) {
					$request->session()->flash('notification', trans('app.No modems found. Insert at least one modem and press restart current gateway') );
				}
		} else {
			$modems = Modems::where('name', 'LIKE', '%'.$filter.'%')
				->paginate(10);
		}
		return view('modems.index')
				->with('modems', $modems)
				->with('filter', $filter);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		$modems = Modems::findOrFail($id);
		return view('modems.show')
				->with('modems',	$modems)
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
		$modems = Modems::findOrFail($id);
		return view('modems.edit')
				->with('modems', $modems)
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
		$modems = Modems::findOrFail($id);
		$modems->update($request->all());
		return redirect()->action('ModemsController@show', [$id]);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		$modems = Modems::findOrFail($id);
		$modems->delete();
		return redirect()->action('ModemsController@index');
	}



	public function delivery($id)
	{
		$message = Spams::findOrFail($id);
		$message->status = '1. Delivered';
		$message->update();
		return("ok");
	}


	public function receive($from, $to, $text, $char, $code, $time, $smsc)
	{

		$message = Spams::create();
		$request = [];
		$request['from'] 		= preg_replace( '/[^0-9]/', '', $from );
			$request['from'][0] = '8';
		$request['to']			= preg_replace( '/[^0-9]/', '', $to );
			$request['to'][0] 	= '8';
		$request['text'] 		= $text;
		$request['char'] 		= $char;
		$request['code'] 		= $code;
		$request['time'] 		= $time;
		$request['raw'] 		= serialize($request);

		if ( isset($request['from']) AND isset($request['char']) AND isset($request['code']) ) {
			if ($request['code'] == "2") {
				if ($request['char'] == "UTF-8") {
					$request['text'] = urldecode($request['text']);
				};
				if ($request['char'] == "UTF-16BE") {
					$request['text'] = mb_convert_encoding(urldecode($request['text']), "utf-8", "ucs-2be");
				}
			};
			if ($request['code'] == "0") {
				// $request['text'] = $request['text']; // not necessary
			}
		}

		$message->from 		= $request['from'];
		$message->to   		= $request['to'];
		$message->text 		= $request['text'];
		$message->charset 	= $request['char'];
		$message->coding 	= $request['code'];
		$message->raw 		= $request['raw'];
		$message->save();

		$modem = Modems::where('name', $smsc)->first();
		$modem->sender = $request['to'];
		$modem->update();

		return("ok");
	}
}
