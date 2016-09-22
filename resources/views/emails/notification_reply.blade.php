<a href="<?php echo action('UsersController@show', $user->id);?>"><?php echo $user->name; ?></a>

 оставил(а) в кейсе <a href="<?php echo action('CasesController@show', $case->id);?>">[#<?php echo $case->id; ?>] <?php echo $case->name; ?></a> новое сообщение:

<hr>

<pre>
<?php
	echo mb_substr($msg->text, 0, 100)."...";
?>
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

<span>Это письмо было сформировано автоматически, пожалуйста, <strong style="color:red">не отвечайте на него.</strong></span><br>
<span>Для ответа перейдите в личный кабинет по <a href="<?php echo action('CasesController@show', $case->id);?>">ссылке</a></span><br>
<span>С уважением, ИТ отдел.</span><br>