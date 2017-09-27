@extends('admin.layout')

@section('breadcrumbs')
	<li>{{ link_to_route( 'admin', trans ( 'admin_titles.main_title' ) ) }}</li>
	<li>{{ link_to_route ('admin.'.$params['route'].'.index', trans('admin_titles.'.$params['route'].'.titles') ) }}</li>

	@if ( $edit_type == 'create' )
		<li class="active">{{ trans('admin_titles.adding') }} </li>
	@else
		<li class="active">{{trans ( 'admin_titles.editing' ) }} "{{ $item->title }}" </li>
	@endif

@endsection

@section('header')

	@if ( $edit_type == 'edit' )
		<a href="{{route('admin.'.$params['route'].'.create')}}" class="btn btn-labeled btn-success pull-right">
			<span class="btn-label">{{ HTML::icon('plus'); }}</span>{{ trans ( 'admin_titles.'.$params['route'].'.add_title' ) }}
		</a>

		<a href="{{route('admin.photos.index', [$params['model'], $item->id] ) }}" class="btn btn-labeled btn-info pull-right margin-right-xs">
			<span class="btn-label">{{ HTML::icon('camera'); }}</span>{{ trans ( 'admin_titles.'.$params['route'].'.photos' ) }}
		</a>

		<a href="{{route('admin.files.index', [$params['model'], $item->id] ) }}" class="btn btn-labeled btn-info pull-right margin-right-xs">
			<span class="btn-label">{{ HTML::icon('file'); }}</span>{{ trans ( 'admin_titles.'.$params['route'].'.files' ) }}
		</a>
	@endif

@endsection

@section('content')

	@if ( $edit_type == 'create' )

		{{ Form::model($item, ['method' => 'post', 'route' => ['admin.'.$params['route'].'.store'], 'files' => true,'class' => 'form-horizontal', 'id' => 'form-std']) }}

	@else

		{{ Form::model($item, ['method' => 'put', 'route' => ['admin.'.$params['route'].'.update', $item->id], 'files' => true,'class' => 'form-horizontal']) }}

	@endif

		@include('admin.'.$params['route'].'.edit._form')

	{{ Form::close() }}

@endsection