<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Cases;
use App\Files;
use App\Messages;
use App\User;

use Auth;
use DB;

class UsersController extends Controller
{

	public function __construct()
	{
		//$this->middleware('auth');
	}



	public function index(Request $request)
	{
		// filered version
		// $filter = trim($request->input('filter'));
		// if (strlen($filter)==0) {
		// 	$users 	= User::paginate(50);
		// } else {
		// 	$users 	= User::where('id', 'LIKE', '%'.$filter.'%')
		// 		->paginate(50);
		// }

		$users 	= User::orderBy('name')->get();

		return view('users.index_table')
				->with('users', 			$users)
				// ->with('filter', 			$filter)
		;
	}



	public function create()
	{
		$types = DB::table('types')->orderBy('id', 'asc')->get();
		return view('cases.create')
				->with('users',		$users)
				// ->with('typesIds',	'[]')
		;

	}



	public function store(Request $request)
	{
	}



	public function upload()
	{
		dd($this);
	}



	public function show($id)
	{
		$user = User::findOrFail($id);
		return view('users.show')->with('user', $user);
	}



	public function edit($id)
	{
		$case 		= Files::findOrFail($id);
		// $sets 			= Sets::lists('name', 'id');
		// $performersIds	= $phone->performers->lists('id')->toArray();
		return view('cases.edit')
				->with('case',				$case)
				// ->with('sets',					$sets)
				// ->with('performersIds', 	$performersIds)
				;
	}



	public function update(Request $request, $id)
	{

		$case = Files::findOrFail($id);

		// if ( !is_null($request->input('performers')) ) {
		// 	$case->performers()->associate($request->input('performers')[0]);
		// } else {
		// 	// $phone->performers()->detach();
		// }
		// if ( !is_null($request->input('performers')) ) {
		// 	$phone->performers()->sync($request->input('performers'));
		// } else {
		// 	$phone->performers()->detach();
		// }

		$case->update( $request->all() );
		return redirect()->action('CasesController@show', [$id]);
	}



	public function destroy($id)
	{
		$performer = Files::findOrFail($id);
		$performer->delete();
		return redirect()->action('CasesController@index');
	}



	public function getOriginal($id)
	{
		// $user = Auth::user();
		// dd($user->id);
		$file = Files::findOrFail($id);
		$file->downloaded++;
		$file->save();
		// $img = Storage::get($file->name_stored);
		// dd(Storage);
		//return Response::make($img, 200, ['Content-Type' => 'image/jpeg']);

		// return view('files.get')
		// 		->with('link', storage_path() . '/' . $file->name_stored)
		// ;

		return Response::download(storage_path() . '/uploads/' . $file->original);
	}



	public function getThumbnail($id)
	{
		$file = Files::findOrFail($id);
		// return Response::download(storage_path() . '/' . $file->thumbnail);

		dd(storage_path() . '/uploads' . $file->thumbnail);

		return storage_path() . '/uploads' . $file->thumbnail;
	}



	public function profile()
	{
		$user = Auth::user();
		return view('users.profile')->with('user', $user);
	}



}
