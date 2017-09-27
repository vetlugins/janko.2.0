<h1>Запись на прием с сайта Наномед</h1>
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
@if ($fields['text'])
	Опишите к кому хотите записаться и с какой проблемой: <b>{{ $fields['text'] }}</b><br>
@endif


