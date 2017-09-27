<h1>Был совершен вызов замерщика</h1>
<h3>Пользователь указал следующие данные:</h3>
@if ($email)
	E-mail: {{ $email }}<br>
@endif

@if ($name)
	Имя: {{ $name }}<br>
@endif

@if ($phone)
	Телефон: {{ $phone }}<br>
@endif

@if ($address)
	Адрес: {{ $address }}<br>
@endif


