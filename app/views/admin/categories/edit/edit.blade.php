@extends('admin.layout')

@section('breadcrumbs')
	<li>{{ link_to_route( 'admin', trans ( 'admin_titles.main_title' ) ) }}</li>
	<li>{{ link_to_route ('admin.'.$params['route'].'.index', 'Категории каталога' ) }}</li>

	@if ( $params['edit_type'] == 'create' )
		<li class="active">{{ trans('admin_titles.adding') }} </li>
	@else
		<li class="active">{{trans ( 'admin_titles.editing' ) }} "{{ $item->title }}" </li>
	@endif

@endsection

@section('header')

	@if ( $params['edit_type'] == 'edit' )

		<a href="{{route('admin.'.$params['route'].'.create')}}" class="btn btn-labeled btn-success pull-right">
			<span class="btn-label">{{ HTML::icon('plus'); }}</span> Добавить категорию
		</a>

	@endif

@endsection

@section('content')

	@if ( $params['edit_type'] == 'create' )

		{{ Form::model($item, ['method' => 'post', 'route' => ['admin.'.$params['route'].'.store'], 'files' => true,'class' => 'form-horizontal', 'id' => 'form-std']) }}

	@else

		{{ Form::model($item, ['method' => 'put', 'route' => ['admin.'.$params['route'].'.update', $item->id], 'files' => true,'class' => 'form-horizontal']) }}

	@endif

		@include('admin.'.$params['route'].'.edit._form')

	{{ Form::close() }}

@endsection