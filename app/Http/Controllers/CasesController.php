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
use CloudConvert\Api;

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
		//$types = DB::table('types')->orderBy('id', 'asc')->get();
		return view('cases.create')
				// ->with('types',		$types)
				// ->with('typesIds',	'[]')
		;
	}



	public function store(Request $request)
	{

		// $this->validate($request, [
		// 	// 'text' 			=> 'required|min:10',
		// 	// 'attachments' 	=> 'max:1',
		// ]);

		//return($request->all());


		//CASE
		$case = new Cases($request->all());
			Auth::user()->cases()->save($case);


		//MESSAGE
		$message = new Messages($request->all());
		$message->case_id = $case->id;
			Auth::user()->messages()->save($message);


		//FILES
		if (!is_null($request->attachments[0])) {
			foreach ($request->attachments as $attachment) {

				$name 		= $attachment->getClientOriginalName();
				$ext 		= $attachment->getClientOriginalExtension();
				$mimetype	= $attachment->getMimeType();
				$size 		= $attachment->getClientSize();
				$temp_file 	= $attachment->getRealPath();
				$original 	= $case->id . '/' . md5($name . time() . '0') . '.' . $ext;
				$converted 	= $case->id . '/' . md5($name . time() . '1') . '.' . $ext;
				$thumbnail 	= $case->id . '/' . md5($name . time() . '2') . '.' . $ext;

				//new file
				$file = new Files([
					'name' 			=> $name,
					'ext' 			=> $ext,
					'mimetype'		=> $mimetype,
					'size'			=> $size,
					'original' 		=> $original,
					//'converted' 	=> $converted,
					//'thumbnail'	=> $thumbnail,
					'message_id' 	=> $message->id
				]);

				//storing original
				Storage::disk('uploads')->put($original, file_get_contents($temp_file));

				//FILES WITH PREVIEW (IMAGES)
				if ( substr($attachment->getMimeType(), 0, 5) == 'image' ) {
					Storage::disk('uploads')->put($converted,Image::make($temp_file)->resize(1280, null, function($callback){$callback->aspectRatio();$callback->upsize();})->stream($ext, 50));
					Storage::disk('thumbnails')->put($thumbnail,Image::make($temp_file)->fit(100, 100, function($callback){$callback->upsize();})->stream($ext, 75));
					$file->thumbnail = $thumbnail;
					$file->converted = $converted;
				}

				// //NO PREVIEW FILES (DOCS, APPS)
				// if ( substr($attachment->getMimeType(), 0, 5) == 'appli' ) {
				// 	//Storage::disk('uploads')->put($original, file_get_contents($temp_file));
				// }

				Auth::user()->files()->save($file);

			}
		}

		//$this->validate($request, ['id' => 'unique:cases|required|regex:/^89\d{9}$/']);
		// Messages::create($request->all());
		return redirect()->action('CasesController@show', [$case->id]);
	}



	public function show($id)
	{
		$case 			= Cases::findOrFail($id);
		$message_first  = Messages::where('case_id', $case->id)->orderby('created_at', 'asc')->first();
		$messages 		= Messages::where('case_id', $case->id)->orderby('created_at', 'asc')->get()->splice(1);
		$users 			= User::orderby('name', 'asc')->lists('name', 'id');
		$usersIds 		= $users->lists('id')->toArray();
		return view('cases.show')
				->with('case',			$case)
				->with('messages',		$messages)
				->with('message_first',	$message_first)
				->with('users',			$users)
				->with('usersIds',		$usersIds)
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
