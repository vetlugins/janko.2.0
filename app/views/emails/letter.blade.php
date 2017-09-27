<h1>Новое письмо с сайта ГК "ВАРТЭ"</h1>
<h3>Тема письма: {{$fields['subject']}}</h3>
@if ($fields['name'])
	ФИО: <b>{{ $fields['name'] }}</b><br>
@endif
@if ($fields['phone'])
	Номер телефона: <b>{{ $fields['phone'] }}</b><br>
@endif
@if ($fields['email'])
	Email отправителя: <b>{{ $fields['email'] }}</b><br>
@endif
@if ($fields['text'])
	<p>Текст письма:</p>
	<div>{{ $fields['text'] }}</div>
	<br>
	<br>
@endif
@if ($fields['date'])
	Дата отправки: <b>{{ $fields['date'] }}</b><br>
@endif


