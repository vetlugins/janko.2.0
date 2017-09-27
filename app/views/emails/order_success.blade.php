<h2>Оформлен новый заказ в интернет-магазине ГК "Варте"</h2>
<h3>Были указаны следующие данные:</h3>

@if ($fields['person_name'])
	Имя: {{ $fields['person_name'] }}<br>
@endif

@if ($fields['person_phone'])
	Телефон: {{ $fields['person_phone'] }}<br>
@endif

@if ($fields['person_email'])
	Адрес электронной почты: {{ $fields['person_email'] }}<br>
@endif

@if ($fields['person_address'])
	Адрес: {{ $fields['person_address'] }}<br>
@endif

@if ($fields['person_message'])
	Комментарий к заказу: {{ $fields['person_message'] }}<br>
@endif

@if ($fields['person_company'])
	Компания: {{ $fields['person_company'] }}<br>
@endif

@if ($fields['person_inn'])
	ИНН: {{ $fields['person_inn'] }}<br>
@endif

<style>
	td {
		padding: 3px;
		font-family: Trebuchet MS;
	}

	tr {
		border-bottom: 5px transparent solid;
	}
</style>

<h3>Были заказаны следующие товары</h3>
<table cellpadding="5" cellspacing="5" border="0" style="margin-bottom: 30px">
	<tr style="background-color: #f1eded">
		<th style="padding: 10px 5px"><b>Наименование товара</b></th>
		<th style="padding: 10px 5px"><b>Количество</b></th>
		<th style="padding: 10px 5px"><b>Цена</b></th>
	</tr>
	@foreach ($fields['products_list'] as $product)
	<tr>
			<td style="padding: 10px 5px">{{ $product->title }}</td>
			<td style="padding: 10px 5px; text-align: center">{{ $product->pivot->amount }}</td>
			<td style="padding: 10px 5px; text-align: center">{{ output_numbers ( $product->pivot->cost ) }}</td>
	</tr>
	@endforeach
</table>

<br>
Общая сумма заказа: <b>{{ output_numbers ( $fields['total_cost'] ) }}</b>