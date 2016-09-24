<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>{{ env('APP_NAME') }} / @yield('title')</title>
	</head>
<body style="font-family: sans-serif; max-width: 777px; width: 777px; margin: 0 auto;">




	{{-- LOGO --}}
	<div style="text-align: center; padding: 10px 0;">
		<a href="<?php echo url('/'); ?>"><img src="<?php echo url('/').'/images/logo96.png'; ?>"></a><br>
	</div>



	{{-- MAIN CONTENT BLOCK --}}
	<div style="text-align: left; padding: 10px; margin: 10px 0">
		@yield('content')
	</div>




	{{-- FOOTER --}}
	<footer>
		<div style="text-align: center; padding: 10px;">
			<p style="color: #969696; font-size: 11px">
				@yield('footer')
				Это письмо было сформировано автоматически, пожалуйста, <strong style="color:red">не отвечайте на него.</strong><br>
				Напоминаем, что приём заявок в отдел ИТ путём отправки электронного письма на адреса: help@grandbaikal.ru, support@grandbaikal.ru <strong>прекращён</strong>.<br>
				Подать новую заявку и ознакомиться со статусами созданных ранее заявок вы можете через личный кабинет <a href="http://it.grandbaikal.ru/">it.grandbaikal.ru</a><br>
				С уважением, ИТ отдел.<br>
			</p>
		</div><br>
	</footer>



</body>

</html>