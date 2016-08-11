<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Modems;

class ModemsController extends Controller
{



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



	public function create()
	{
		//
	}



	public function store(Request $request)
	{
		//
	}



	public function show($id)
	{
		$modem = Modems::findOrFail($id);
		return view('modems.show')
				->with('modem',	$modem)
			;
	}



	public function edit($id)
	{
		$modems = Modems::findOrFail($id);
		return view('modems.edit')
				->with('modems', $modems)
			;
	}



	public function update(Request $request, $id)
	{
		$modems = Modems::findOrFail($id);
		$modems->update($request->all());
		return redirect()->action('ModemsController@show', [$id]);
	}



	public function destroy($id)
	{
		$modems = Modems::findOrFail($id);
		$modems->delete();
		return redirect()->action('ModemsController@index');
	}



	public function send(Request $request)
	{
		//$this->validate($request, ['to' => 'required|regex:/^89\d{9}$/', 'text'=>'required|min:1|max:60']);
		$modem = Modems::findOrFail($request->modem);
		$result = $modem->send($request->to, $request->text);
		session()->flash('flash_success', 'Text: '.$request->text.' / Modem: '.$modem->name.' / Number: '.$request->to.' / Status message: '.$result);
		//session()->flash('flash_success', 'Message to '.$to.' was sended with status message: '.$result);
		session()->flash('to', $request->to);
		return back();
	}
}
