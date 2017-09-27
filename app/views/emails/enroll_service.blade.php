<h1>Запись на услугу с сайта Наномед</h1>
@if ($fields['services'])
	<h2>{{ $fields['services'] }}</h2>
@endif
<h3>Пользователь указал следующие данные:</h3>
@if ($fields['name'])
	ФИО: <b>{{ $fields['name'] }}</b><br>
@endif
@if ($fields['phone'])
	Номер телефона: <b>{{ $fields['phone'] }}</b><br>
@endif
@if ($fields['date'])
	Желаемая дата и время: <b>{{ $fields['date'] }}</b><br>
@endif


