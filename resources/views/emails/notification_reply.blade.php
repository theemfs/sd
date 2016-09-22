<div style="text-align: center; border-bottom: 1px solid #ccc; padding-bottom: 10px;">
	<a href="<?php echo url('/'); ?>"><img src="<?php echo url('/').'/images/logo96.png'; ?>"></a><br>
</div><br>

<a href="<?php echo action('UsersController@show', $user->id);?>"><?php echo $user->name; ?></a><br>
оставил(а) в кейсе <a href="<?php echo action('CasesController@show', $case->id);?>">[#<?php echo $case->id; ?>] <?php echo $case->name; ?></a> новое сообщение<br>
<span style="color:#969696">(Ниже показана только часть сообщения. Прочесть полностью можно по <a href="<?php echo action('CasesController@show', $case->id);?>" style="color:blue">ссылке</a>)</span><br>

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

<div style="text-align: center; border-bottom: 1px solid #ccc; padding-top: 10px;">
<p style="color: #969696; font-size: 11px">
Вы получили это письмо, так как являетесь участником кейса <a href="<?php echo action('CasesController@show', $case->id);?>">[#<?php echo $case->id; ?>] <?php echo $case->name; ?></a><br><br>

Это письмо было сформировано автоматически, пожалуйста, <strong style="color:red">не отвечайте на него.</strong><br>
Для проверки статуса и ответов по данному кейсу перейдите по <a href="<?php echo action('CasesController@show', $case->id);?>">ссылке</a><br>

Напоминаем, что приём заявок в отдел ИТ путём отправки электронного письма на адреса:<br>
help@grandbaikal.ru<br>
support@grandbaikal.ru<br>
<strong>прекращён</strong>.<br><br>
Подать новую заявку и ознакомиться со статусами созданных ранее заявок вы можете через личный кабинет <a href="http://it.grandbaikal.ru/">it.grandbaikal.ru</a><br>
С уважением, ИТ отдел.<br>
</p>
</div><br>