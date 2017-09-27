@extends('admin.layout')

@section('breadcrumbs')
	<li>{{ link_to_route( $cur_lang_route.'admin', trans('admin_titles.main_title') ) }}<span>→</span></li>
	<li class="active">{{ trans('admin_titles.'.$params['route'].'.titles') }}</li>
@endsection

@section('header')

@endsection

@section('content')

<a href="{{URL::route( $cur_lang_route.'admin.'.$params['route'].'.create')}}" class="btn button btn-primary btn-large btn-block">{{ HTML::icon('plus') }} {{ trans('admin_titles.'.$params['route'].'.add_title') }}</a>

	<div class="col-xs-3">
		<div class="alert alert-warning confirm-changes">
			<p>{{ trans('admin_messages.'.$params['route'].'.save_confirm') }}</p>
			<div class="btn-group">
			  {{ Form::open(['route' => $cur_lang_route.'admin.'.$params['route'].'.structure', 'id' => 'structure-form']) }}
				{{ Form::hidden('structure_changes', '') }}
			  {{ Form::close() }}
			  <button type="button" id="submit-structure-changes" class="btn button f-left btn-success">{{ HTML::icon('check', trans('admin_titles.item_save')) }}</button>
			  <button type="button" onclick="location.reload(true)" class="btn button f-left btn-danger">{{ HTML::icon('times', trans('admin_titles.item_cancel')) }}</button>
			</div>
		</div>
	</div>
	<div class="col-xs-9 admin-pages-list">
		<!-- список страниц передается через javascript и выводится деревом с помощью jqTree (см. section('head') выше ) -->
    </div>


@stop

