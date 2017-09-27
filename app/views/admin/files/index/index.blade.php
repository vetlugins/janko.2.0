@extends('admin.layout')

@section('breadcrumbs')
	<li>{{ link_to_route('admin', trans('admin_titles.main_title') ) }}</li>
	<li>{{ link_to_route('admin.'.$params['object_route'].'.index', trans ( 'admin_titles.'.$params['object_route'].'.titles' ) ) }}</li>
	@if ( isset ( $params['object_parent_name'] ) )	
	<li>{{ link_to_route('admin.'.$params['object_route'].'.edit', $params['object_parent_name'], $params['object_parent_id'] ) }}</li>
	@endif
	<li>{{ link_to_route('admin.'.$params['object_route'].'.edit', $params['object_name'], $params['object_id'] ) }}</li>
	<li class="active">Файлы</li>
@endsection

@section('header')
	
@endsection

@section('content')

  <div class="row">
	  <div class="col-md-12 col-sm-12">
		  <div class="box">
			  <div class="box-title">
				  <h3>{{ trans('admin_titles.adding') }}</h3>
			  </div>
			  <div class="box-body">
				  {{ Form::open(['method' => 'post', 'url' => '/admin/files/'.$params['object_type'].'/'.$params['object_id'], 'files' => true]) }}
				  @include('admin.'.$params['route'].'._form')
				  {{ Form::close() }}
			  </div>
		  </div>
	  </div>
  </div>

  <div class="row">
	  <div class="col-md-12 col-sm-12">
		  <div class="box">
			  <div class="box-title">
				  <h3>Файлы</h3>
			  </div>
			  <div class="box-body no-padding">
				  @include('admin.'.$params['route'].'._main')
			  </div>
		  </div>
	  </div>
  </div>

@endsection

@section('bottom')
	<script type="text/javascript" src="/js/admin/plugins/bootstrap-file-input/bootstrap-file-input.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			//File Input
			$('.file-inputs').bootstrapFileInput();
		});
	</script>
@endsection