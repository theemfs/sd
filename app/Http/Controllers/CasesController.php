<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Cases;
use App\Messages;
use App\User;
use App\Files;
use App\Statuses;

use Auth;
use Gate;
use DB;
use Storage;
use Image;
use Mail;
// use CloudConvert\Api;
// use Illuminate\Pagination\LengthAwarePaginator as Paginator;
// use App\Policies\CasesPolicy;

class CasesController extends Controller
{

	public function __construct()
	{
		//$this->middleware('auth');
	}



	public function index(Request $request)
	{
		// filered version
		//$filter = trim($request->input('filter'));

		// $cases 	= Cases::orderBy('updated_at', 'desc');
		// dd($cases->paginate(10));

		$cases_author 		= Auth::user()->cases;
		$cases_performer 	= Auth::user()->performerOf;
		$cases_member		= Auth::user()->memberOf;
		$cases_all			= Cases::orderBy('updated_at','desc')->get();
		$cases_not_assigned = collect(DB::select(DB::raw("SELECT * FROM cases WHERE cases.id NOT IN (SELECT case_id FROM case_performers)")));
		// dd($cases_all);
		// $cases_not_assigned = Cases::whereNotIn('book_price', DB::select(DB::raw("SELECT * FROM cases WHERE cases.id NOT IN (SELECT case_id FROM case_performers)")))->get();

		//$cases = new Paginator($cases, $cases->count(), 2, $request);

		// if (strlen($filter)==0) {
		// 	$cases 	= Cases::orderBy('updated_at', 'desc')->paginate(50);
		// } else {
		// 	$cases 	= Cases::where('id', 'LIKE', '%'.$filter.'%')
		// 		->orWhere('text', 'LIKE', '%'.$filter.'%')
		// 		->paginate(50);
		// }



		return view('cases.index')
			->with('cases_author',		$cases_author)
			->with('cases_performer',	$cases_performer)
			->with('cases_member',		$cases_member)
			->with('cases_all',			$cases_all)
			->with('cases_not_assigned',$cases_not_assigned)
			// ->with('filter',			$filter)
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

		$this->validate($request, [
			'name' 			=> 'required|min:10',
			'text' 			=> 'required|min:10',
			// 'attachments' 	=> 'max:1',
		]);

		//return($request->all());


		//CASE
		$case = new Cases($request->all());
		Auth::user()->cases()->save($case);
		$case->members()->sync( array(Auth::user()->id) );
		$case->status_id = 1; //status = new
		$case->save();


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



		// SENDING EMAIL NOTIFICATION
		$data = array(
			'case' => $case,
			'msg' => $message,
			'user' => Auth::user()
		);

		//$subscribers = User::where('can_be_performer', true)->get();
		$subscribers = User::where('is_admin', true)->get();

		foreach ($subscribers as $subscriber) {
			Mail::send('emails.notification_newcase', $data, function($email) use ($case, $message, $subscriber) {
				$email->from( env('MAIL_USERNAME') );
				$email->to($subscriber->email);
				$email->subject("[Case #$case->id]: " . trans('app.New case'));
				$email->priority(2);
			});
		}



		// REDIRECT
		//$this->validate($request, ['id' => 'unique:cases|required|regex:/^89\d{9}$/']);
		// Messages::create($request->all());
		return redirect()->action('CasesController@show', [$case->id]);



	}



	public function show($id)
	{
		$case 			= Cases::findOrFail($id);

		if (Gate::denies('show-case', $case)) {
			return view('errors.403');
		}

		$message_first 			 	= Messages::where('case_id', $case->id)->orderby('created_at', 'asc')->first();
		$messages 					= Messages::where('case_id', $case->id)->orderby('created_at', 'desc')->get();
		//$messages 				= Messages::where('case_id', $case->id)->orderby('created_at', 'desc')->get()->splice(1);
		$users 						= User::orderby('name', 'asc')->lists('name', 'id');
		//$users_can_be_performers 	= User::where('can_be_performer', '1')->orderby('name', 'asc')->lists('name', 'id');
		$users_can_be_performers 	= User::where('can_be_performer', '1')->orderby('name', 'asc')->lists('name', 'id');
		$membersIds 				= $case->members->lists('id')->toArray();
		$performersIds 				= $case->performers->lists('id')->toArray();
		$statuses 					= Statuses::orderby('id', 'asc')->lists('name', 'id');
		$users_members				= User::whereIn('id', $membersIds)->orderby('name', 'asc')->get();
		$users_can_be_members		= User::whereNotIn('id', $membersIds)->orderby('name', 'asc')->get();


		//return([$users_members, $users]);
		//dd($users_members);

		//
		//$statusesIds 				= $case->toArray();

		//return($case->members);

		return view('cases.show')
			->with('case',						$case)
			->with('messages',					$messages)
			->with('message_first',				$message_first)
			->with('users',						$users)
			->with('membersIds',				$membersIds)
			->with('users_can_be_performers',	$users_can_be_performers)
			->with('performersIds',				$performersIds)
			->with('statuses',					$statuses)
			->with('users_members',				$users_members)
			->with('users_can_be_members',		$users_can_be_members)
			// ->with('statusesIds',	$statusesIds)
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
		$case_before = clone($case);



		// CHECK RIGHTS
		if (Gate::denies('update-case', $case)) {
			return view('errors.403');
		}



		// PROCESSING
		if ( !is_null($request->input('performers')) ) {
			$case->performers()->sync($request->input('performers'));
		} else {
			$case->performers()->detach();
		}

		if ( !is_null($request->input('members')) ) {
			$case->members()->sync($request->input('members'));
		} else {
			$case->members()->detach();
		}
		$case->update($request->all());

		if ( date( "Y-m-d H:i", strtotime($request->due_to)) < date("Y-m-d H:i", mktime(0, 0, 0, 1, 1, 1971)) ) {
			$case->due_to = NULL;
		} else {
			$case->due_to = date( "Y-m-d H:i:s", strtotime($request->due_to) );
		}
		$case->update();



		// return([$case->due_to, $case_before->due_to]);
		// GENERATE STATUS MESSAGE
		$message = new Messages();
		$message->is_service_message = 1;
		$message->case_id = $case->id;
			if (!($case_before->status_id == $case->status_id)) {
				$message->text .= trans('app.Status changed: ') . $case_before->status->name . ' -> ' . $case->status->name . "\n";
				Auth::user()->messages()->save($message);
			}
			if (!($case_before->due_to == $case->due_to)) {
				$message->text .= trans('app.Due to changed: ') . $case_before->due_to . ' -> ' . $case->due_to . "\n";
				Auth::user()->messages()->save($message);
			}



		// END
		return redirect()->action('CasesController@show', [$id]);
	}



	public function destroy($id)
	{
		$performer = Cases::findOrFail($id);
		$performer->delete();
		return redirect()->action('CasesController@index');
	}


}
