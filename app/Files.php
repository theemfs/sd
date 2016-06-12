<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Files extends Model
{

	use SoftDeletes;

	//protected $table = 'phones';

	protected $fillable = [
		'id',
		'comment',
		
		'name',
		'ext',

		'mimetype',
		'size',

		'original',
		'converted',
		'thumbnail',

		'user_id',
		'case_id',
		
	];

	protected $dates = [
		'deleted_at'
	];

	

	public function user()
	{
		return $this->belongsTo('App\User', 'user_id');
	}



	public function cases()
	{
		return $this->belongsTo('App\Cases', 'case_id');
	}



	public function upload(UploadedFile $attachment)
	{

		dd($attachment->getRealPath());

		$path 		= 'cases/' . $this->case_id . '/';
		$hash 		= md5($this->name . time());
		$original 	= $path . $hash . '.' . $this->ext;

		dd($original);

		//$unique_filename_mini 	= $path . $this->case_id . '/' . $hash . '_mini.' . $attachment->getClientOriginalExtension();

		//saving original
		Storage::put(
			$original,
			file_get_contents($attachment->getRealPath())
		);

		//creating new file

		//creating a thumb and converted copy of image
		if ( substr($attachment->getMimeType(), 0, 5) == 'image' ) {
			Storage::disk('uploads')->put(
				// $unique_filename_mini,
				$unique_filename,
				Image::make( $attachment
					->getRealPath())
					->resize(64, null, function($callback) {
						$callback->aspectRatio();
						$callback->upsize();							
					})
					->stream($attachment->getClientOriginalExtension(), 75)
			);

			Storage::disk('uploads')->put(
				// $unique_filename_mini,
				$unique_filename,
				Image::make( $attachment
					->getRealPath())
					->resize(1280, null, function($callback) {
						$callback->aspectRatio();
						$callback->upsize();							
					})
					->stream($attachment->getClientOriginalExtension(), 75)
			);	
		}
	}

	// public function spectators()
	// {
	// 	return $this->belongsToMany('App\User');
	// }
	/**
	 * Performer associated with many Numbers 	 */
	// public function sets()
	// {
	// 	return $this->belongsToMany('App\Sets');
	// }

	// public function messages()
	// {
	// 	return $this->hasMany('App\Messages');
	// }

	// public function files()
	// {
	// 	return $this->hasMany('App\Files');
	// }



	// /**
	//  * Get a list of Ids of assigned groups to the Performer
	//  */
	// public function getGroupsListAttributes()
	// {
	//     //return $this->groups->lists('id');
	// }

	// public function isImage($id)
	// {
	// 	// $file = Files::find($id);

	// 	// if ( substr() ) {
	// 	// 	return false	
	// 	// } else {
	// 	// 	return true	
	// 	// }
	//}

}
