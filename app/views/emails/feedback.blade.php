<h1>Новое сообщение с формы обратной связи</h1>
<h3>Пользователь указал следующие данные:</h3>
@if ($email)
	E-mail: {{ $email }}<br>
@endif

@if ($name)
	Имя: {{ $name }}<br>
@endif

@if ($text)
	Текст сообщения: {{ $text }}<br>
@endif


