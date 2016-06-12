<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Cases;
use App\Messages;
use App\User;
use App\Files;

use Auth;
use DB;
use Storage;
use Image;

class CasesController extends Controller
{

	public function __construct()
	{
		//$this->middleware('auth');
	}



	public function index(Request $request)
	{
		// filered version
		$filter = trim($request->input('filter'));
		if (strlen($filter)==0) {
			$cases 	= Cases::orderBy('updated_at', 'desc')->paginate(50);
		} else {
			$cases 	= Cases::where('id', 'LIKE', '%'.$filter.'%')
				->orWhere('text', 'LIKE', '%'.$filter.'%')
				->paginate(50);
		}

		return view('cases.index')
				->with('cases',		$cases)
				->with('filter',	$filter)
		;
	}



	public function create()
	{
		$types = DB::table('types')->orderBy('id', 'asc')->get();
		return view('cases.create')
				->with('types',		$types)
				->with('typesIds',	'[]')
		;
	}



	public function store(Request $request)
	{

		$this->validate($request, [
			// 'text' 			=> 'required|min:10',
			// 'attachments' 	=> 'max:1',
		]);

		$case = new Cases($request->all());
		Auth::user()->cases()->save($case);
		
		if (!is_null($request->attachments[0])) {
			foreach ($request->attachments as $attachment) {

				$path 		= 'cases/' . $case->id . '/';
				$name 		= $attachment->getClientOriginalName();
				$ext 		= $attachment->getClientOriginalExtension();
				$mimetype	= $attachment->getMimeType();
				$size 		= $attachment->getClientSize();
				$temp_file 	= $attachment->getRealPath();
				// $hash 		= md5($name . time());
				$original 	= $path . md5($name . time() . '0') . '.' . $ext;
				$converted 	= $path . md5($name . time() . '1') . '.' . $ext;
				$thumbnail 	= $path . md5($name . time() . '2') . '.' . $ext;

				//new file
				$file = new Files([
					'name' 			=> $name,
					'ext' 			=> $ext,
					'mimetype'		=> $mimetype,
					'size'			=> $size,

					'original' 		=> $original,
					'converted' 	=> $converted,
					'thumbnail'		=> $thumbnail,

					'case_id' 		=> $case->id,
				]);

				//storing original
				Storage::disk('originals')->put($original, file_get_contents($temp_file));

				//creating a thumb and converted copy of image
				if ( substr($attachment->getMimeType(), 0, 5) == 'image' ) {

					//storing converted
					Storage::disk('uploads')->put(
						$converted,
						Image::make($temp_file)->resize(1280, null, function($callback) {
							$callback->aspectRatio();
							$callback->upsize();							
						})->stream($ext, 50)
					);

					//storing thumbnail
					Storage::disk('uploads')->put(
						$thumbnail,
						Image::make($temp_file)->fit(100, 100, function($callback) {
							$callback->upsize();							
						})->stream($ext, 75)
					);
				}
				
				Auth::user()->files()->save($file);

			}
		}
		
		
		//$this->validate($request, ['id' => 'unique:cases|required|regex:/^89\d{9}$/']);
		// Messages::create($request->all());
		return redirect()->action('CasesController@show', [$case->id]);
	}



	public function show($id)
	{
		$case = Cases::findOrFail($id);
		$files = Files::where('case_id', $case->id)->get();

		return view('cases.show')
				->with('case',	$case)
				->with('files',	$files)
		;
	}

	

	public function edit($id)
	{
		$case = Cases::findOrFail($id);
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

		$case = Cases::findOrFail($id);

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
		$performer = Cases::findOrFail($id);
		$performer->delete();
		return redirect()->action('CasesController@index');
	}


}
