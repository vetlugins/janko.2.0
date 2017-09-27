<h1>Вызов врача на дом с сайта Наномед</h1>
<h3>Пользователь указал следующие данные:</h3>
@if ($fields['name'])
	ФИО: <b>{{ $fields['name'] }}</b><br>
@endif
@if ($fields['phone'])
	Номер телефона: <b>{{ $fields['phone'] }}</b><br>
@endif

