@extends('admin.layout')

@section('head')

@endsection

@section('breadcrumbs')
	<li>{{ link_to_route('admin', trans('admin_titles.main_title') ) }}</li>
	<li>{{ link_to_route('admin.'.$params['object_route'].'.index', trans ( 'admin_titles.'.$params['object_route'].'.titles' ) ) }}</li>
	@if ( isset ( $params['object_parent_name'] ) )	
	<li>{{ link_to_route('admin.'.$params['object_route'].'.edit', $params['object_parent_name'], $params['object_parent_id'] ) }}</li>
	@endif
	<li>{{ link_to_route('admin.'.$params['object_route'].'.edit', $params['object_name'], $params['object_id'] ) }}</li>
	<li class="active">{{ trans('admin_titles.'.$params['route'].'.titles') }}</li>
@endsection

@section('header')
	<a href="{{ route('admin.'.$params['route'].'.create',[$params['object_type'], $params['object_id']])}}" class="btn btn-labeled btn-success pull-right">
		<span class="btn-label">{{ HTML::icon('plus'); }}</span>{{ trans ( 'admin_titles.'.$params['route'].'.add_title' ) }}
	</a>
@endsection

@section('content')

	@if(count($photos))

		<!-- Main row -->
		@foreach($photos->chunk(4) as $items)
			<div class="row">
				@foreach($items as $photo)
					@include('admin.photos.index._item')
				@endforeach
			</div>
		@endforeach

	@else

		<div class="alert alert-info">
			<p>Фотографий еще нет. <a href="{{ route('admin.'.$params['route'].'.create',[$params['object_type'], $params['object_id']])}}">Добавить</a></p>
		</div>

	@endif

@endsection