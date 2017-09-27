<h3>Пользователь указал следующие данные:</h3>
@if ($name)
	Имя: {{ $name }}<br>
@endif

@if ($email)
	Телефон: {{ $email }}<br>
@endif

@if ($msg)
	Текст сообщения: {{ $msg }}
@endif
