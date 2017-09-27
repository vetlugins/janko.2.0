<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>Восстановление пароля</h2>

		<div>
			Чтобы сбросить пароль, заполните эту форму: {{ URL::route('admin.password.reset', array($token)) }}.
		</div>
	</body>
</html>
