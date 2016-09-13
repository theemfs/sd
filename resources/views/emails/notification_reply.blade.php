<a href="<?php echo action('UsersController@show', $user->id);?>"><?php echo $user->name; ?></a>

 оставил(а) в кейсе <a href="<?php echo action('CasesController@show', $case->id);?>">[#<?php echo $case->id; ?>] <?php echo $case->name; ?></a> новое сообщение:

<hr>

<pre>
<?php echo $msg->text; ?>
</pre>

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

<p><?php echo $user->title; / echo $user->department; ?></p>
<p><?php echo $user->phone; / echo $user->mobile; ?></p>

<hr>

<p>Это письмо было сформировано автоматически, пожалуйста, не отвечайте на него.</p>
<p>Для ответа перейдите в личный кабинет по <a href="<?php echo action('CasesController@show', $case->id);?>">ссылке</a></p>
<p>С уважением, ИТ отдел.</p>