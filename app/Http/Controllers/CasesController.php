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
use Carbon\Carbon;
// use CloudConvert\Api;
// use Illuminate\Pagination\LengthAwarePaginator as Paginator;
// use App\Policies\CasesPolicy;

class CasesController extends Controller
{

	public function __construct()
	{
	}



	public function index(Request $request)
	{

		$cases_author 		= Auth::user()->authorOfOpen;													// where I am an author
		$cases_member		= Auth::user()->memberOfOpen;													// where I am a member
		$cases_closed		= Auth::user()->casesAllClosed();												// closed AND where I am author || performer || member
		$cases_performer 	= Auth::user()->performerOfOpen;												// where I am a performer
		$cases_open			= Cases::where('status_id','<>','5')->orderBy('updated_at','desc')->get();
		$cases_closed_all	= Cases::where('status_id','5')->orderBy('updated_at','desc')->get();
		$cases_new_ids 		= array_column( DB::select(DB::raw("SELECT id FROM cases WHERE cases.id NOT IN (SELECT case_id FROM case_performers)")), "id");
		$cases_new 			= Cases::whereIn('id',$cases_new_ids)->orderBy('updated_at','desc')->get();


		// ONLY FOR ADMIN
		if (Auth::user()->is_admin) {
				return view('cases.index_table')
					->with('cases_author',		$cases_author)
					->with('cases_closed',		$cases_closed_all)
					->with('cases_member',		$cases_member)
					->with('cases_new',			$cases_new)
					->with('cases_open',		$cases_open)
					->with('cases_performer',	$cases_performer)
				;
		// FOR USERS
		} else {
				return view('cases.index_table')
					->with('cases_author',		$cases_author)
					->with('cases_closed',		$cases_closed)
					->with('cases_member',		$cases_member)
					->with('cases_new',			$cases_new)
					->with('cases_open',		$cases_open)
					->with('cases_performer',	$cases_performer)
				;
		}

	}



	// where I am an author
	public function author()
	{
		$cases = Auth::user()->authorOfOpen;
		return view('cases.index_table_single')
				->with('cases', $cases)
		;
	}



	public function create()
	{
		return view('cases.create');
	}



	public function store(Request $request)
	{

		$this->validate($request, [
			'name' 			=> 'required|min:10',
			'text' 			=> 'required|min:10',
			// 'attachments' 	=> 'max:1',
		]);



		//CASE
		$case = new Cases($request->all());
		Auth::user()->authorOf()->save($case);
		$case->members()->sync( array(Auth::user()->id) );
		$case->status_id = 1; //status = new
		$case->last_reply_at = Carbon::now();
		$case->last_replier_id = Auth::user()->id;
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
			Mail::queue('emails.notification_newcase', $data, function($email) use ($case, $message, $subscriber) {
				$email->from( env('MAIL_USERNAME') );
				$email->to($subscriber->email);
				$email->subject("[" . trans('app.Case') . " #$case->id]: \"$case->name\". " . trans('app.New case') );
				$email->priority(2); //high
			});
		}



		// REDIRECT
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
		$users 						= User::where('is_active', '1')->orderby('name', 'asc')->lists('name', 'id');
		//$messages 				= Messages::where('case_id', $case->id)->orderby('created_at', 'desc')->get()->splice(1);
		//$users_can_be_performers 	= User::where('can_be_performer', '1')->orderby('name', 'asc')->lists('name', 'id');

		//$statuses 					= Statuses::orderby('id', 'asc')->lists('name', 'id');
		$statuses 					= Statuses::orderby('id', 'asc')->get();

		//$users_performers 		= User::where('can_be_performer', '1')->where('is_active', '1')->orderby('name', 'asc')->lists('name', 'id');
		$performersIds 				= $case->performers->lists('id')->toArray();
		$users_performers			= User::whereIn('id', $performersIds)->orderby('name', 'asc')->get();
		$users_can_be_performers 	= User::whereNotIn('id', $performersIds)->where('can_be_performer', '1')->where('is_active', '1')->orderby('name', 'asc')->get();;

		$membersIds 				= $case->members->lists('id')->toArray();
		$users_members				= User::whereIn('id', $membersIds)->orderby('name', 'asc')->get();
		$users_can_be_members		= User::whereNotIn('id', $membersIds)->where('is_active', '1')->orderby('name', 'asc')->get();

		//return([$users_members, $users]);
		//dd($users_members);

		//
		//$statusesIds 				= $case->toArray();

		//return($case->members);

		return view('cases.show')
			->with('case',						$case)
			->with('messages',					$messages)
			// ->with('message_first',				$message_first)
			->with('users',						$users)
			->with('membersIds',				$membersIds)
			->with('users_performers',			$users_performers)
			->with('users_can_be_performers',	$users_can_be_performers)
			->with('performersIds',				$performersIds)
			->with('statuses',					$statuses)
			->with('users_members',				$users_members)
			->with('users_can_be_members',		$users_can_be_members)
			// ->with('statusesIds',	$statusesIds)
		;

		// if ($case->status->is_closed) {
		// 	return view('cases.show_closed')
		// 		->with('case',						$case)
		// 		->with('messages',					$messages)
		// 		->with('message_first',				$message_first)
		// 		->with('users',						$users)
		// 		->with('membersIds',				$membersIds)
		// 		->with('users_can_be_performers',	$users_can_be_performers)
		// 		->with('performersIds',				$performersIds)
		// 		->with('statuses',					$statuses)
		// 		->with('users_members',				$users_members)
		// 		->with('users_can_be_members',		$users_can_be_members)
		// 		// ->with('statusesIds',	$statusesIds)
		// 	;
		// } else {
		// 	return view('cases.show_wide')
		// 		->with('case',						$case)
		// 		->with('messages',					$messages)
		// 		->with('message_first',				$message_first)
		// 		->with('users',						$users)
		// 		->with('membersIds',				$membersIds)
		// 		->with('users_can_be_performers',	$users_can_be_performers)
		// 		->with('performersIds',				$performersIds)
		// 		->with('statuses',					$statuses)
		// 		->with('users_members',				$users_members)
		// 		->with('users_can_be_members',		$users_can_be_members)
		// 		// ->with('statusesIds',	$statusesIds)
		// 	;
		// }

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
		$performers_compare = array();
		$performers_compare[0] = array_column($case_before->performers->toArray(), 'id');



		// CHECK RIGHTS
		if (Gate::denies('update-case', $case)) {
			return view('errors.403');
		}



		// PROCESSING SYNC PERFORMERS, MEMBERS
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



		// DUE_TO SET TO NULL IF DATE IN TOO PAST
		if ( date( "Y-m-d H:i", strtotime($request->due_to)) < date("Y-m-d H:i", mktime(0, 0, 0, 1, 1, 1971)) ) {
			$case->due_to = NULL;
		} else {
			$case->due_to = date( "Y-m-d H:i:s", strtotime($request->due_to) );
		}

		$case->update();



		// SENDING EMAIL NOTIFICATION
		$performers_compare[1] = array_column($case->performers->toArray(), 'id');
		$detached = array_diff($performers_compare[0], $performers_compare[1]);
		$attached = array_diff($performers_compare[1], $performers_compare[0]);

		//return([count($attached), count($detached)]);

		$message = new Messages();
		$message->is_service_message = 1;
		$message->case_id = $case->id;
			if ( count($attached)>0 ) {
				$message->text .= trans('app.Attached Performers') . ":\n";
				foreach($attached as $performer_id) {
					$performer = User::findOrFail($performer_id);
					$message->text .= "+" . $performer->name . "\n";
				}
				Auth::user()->messages()->save($message);
			}

			if ( count($detached)>0 ) {
				$message->text .= trans('app.Detached Performers') . ":\n";
				foreach($detached as $performer_id) {
					$performer = User::findOrFail($performer_id);
					$message->text .= "-" . $performer->name . "\n";
				}
				Auth::user()->messages()->save($message);
			}

		$data = array(
			'case' => $case,
			'msg' => $message,
			'user' => Auth::user()
		);

		foreach($attached as $performer_id) {
			$performer = User::findOrFail($performer_id);
			Mail::queue('emails.notification_performer_assignment', $data, function($email) use ($case, $message, $performer) {
				$email->from( env('MAIL_USERNAME') );
				$email->to($performer->email);
				$email->subject("[" . trans('app.Case') . " #$case->id]: \"$case->name\". " . trans('app.Performer Attaching') );
				$email->priority(2); //high
			});

		}

		// return([
		// 	"detached" => $detached,
		// 	"attached" => $attached
		// ]);



		// //$subscribers = User::where('can_be_performer', true)->get();
		// $subscribers = User::where('is_admin', true)->get();

		// foreach ($subscribers as $subscriber) {
		// 	Mail::queue('emails.notification_newcase', $data, function($email) use ($case, $message, $subscriber) {
		// 		$email->from( env('MAIL_USERNAME') );
		// 		$email->to($subscriber->email);
		// 		$email->subject("[" . trans('app.Case') . " #$case->id]: \"$case->name\". " . trans('app.New case') );
		// 		$email->priority(2); //high
		// 	});
		// }



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