@extends('emails.emails')



@section('title', '[' . trans('app.Case') . '#' . $case->id . ']: \'' . $case->name . '\'. ' . trans('app.New Case'))



@section('content')

<div style="text-align: center;">
<a href="<?php echo action('UsersController@show', $user->id);?>"><?php echo $user->name; ?></a><br>
создал(а) новый кейс <a href="<?php echo action('CasesController@show', $case->id);?>">[# <?php echo $case->id; ?>] <?php echo $case->name; ?></a>:
</div>

<hr>

<pre><?php echo $msg->text; ?></pre>
<?php
	foreach ($msg->files as $file) {
		if ( substr($file->mimetype, 0, 5) == 'image'){
			echo "<a href=" . action('FilesController@show', $file->id) . ">";
			echo "<img src=" . url('/') . "/thumbnails/" . $file->thumbnail . " title=" . $file->name . ">";
			echo "</a>";
		} else {
			echo "<a href=" . action('FilesController@show', $file->id) . ">";
			echo "<p>" . $file->name . " [" . human_filesize($file->size) . "]</p>";
			echo "</a>";
		}
	}
?>

<hr>

@endsection



@section('footer')
Вы получили это письмо, так как являетесь участником кейса <a href="<?php echo action('CasesController@show', $case->id);?>">[#<?php echo $case->id; ?>] <?php echo $case->name; ?></a><br><br>
Для проверки статуса и ответов по данному кейсу перейдите по <a href="<?php echo action('CasesController@show', $case->id);?>">ссылке</a><br>
@endsection