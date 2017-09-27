@extends('admin.layout')

@section('breadcrumbs')
	<li>{{ link_to_route('admin', 'Панель управления') }}<span>→</span></li>
	<li>{{ link_to_route('admin.users.index', 'Пользователи') }}<span>→</span></li>
	<li class="active">{{ $items->displayName() }}: активность</li>
@endsection

@section('header')
  
@endsection

@section('content')
      <div class="margin-block"> </div>
  		<ul class="content">
  			@foreach($items->activities as $activity)
				@if($activity->observable)
					  <li></li>					  
					  <!--View::make('admin.users.activity._'.$activity->observable_type.ucfirst($activity->type), compact('activity'))-->
				@endif
  			@endforeach
  		</ul>
      <div class="margin-block"></div>
@stop

