<a href="<?php echo action('UsersController@show', $user->id);?>"><?php echo $user->name; ?></a><br>
<span>оставил(а) в кейсе <a href="<?php echo action('CasesController@show', $case->id);?>">[#<?php echo $case->id; ?>] <?php echo $case->name; ?></a> новое сообщение</span><br>
<span style="color:#969696">(Показана только часть сообщения. Прочесть полностью можно в кейсе по <a href="<?php echo action('CasesController@show', $case->id);?>">ссылке</a>)</span><br>

<hr>

<pre>
<?php
	echo mb_substr($msg->text, 0, 30) . " ...";
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
<span>Для проверки статуса и ответов по данному кейсу перейдите по <a href="<?php echo action('CasesController@show', $case->id);?>">ссылке</a></span><br>
<span>С уважением, ИТ отдел.</span><br>