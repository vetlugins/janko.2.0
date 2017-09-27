@extends('admin.layout')

@section('head')
	<link href="/stylesheets/admin/dropzone/dropzone.css" rel="stylesheet" type="text/css" />
@endsection

@section('breadcrumbs')
	<li>{{ link_to_route('admin', trans('admin_titles.main_title') ) }}</li>
	<li>{{ link_to_route('admin.'.$params['object_route'].'.index', trans ( 'admin_titles.'.$params['object_route'].'.titles' ) ) }}</li>
	@if ( isset ( $params['object_parent_name'] ) )
		<li>{{ link_to_route('admin.'.$params['object_route'].'.edit', $params['object_parent_name'], $params['object_parent_id'] ) }}</li>
	@endif
	<li>{{ link_to_route('admin.'.$params['object_route'].'.edit', $params['object_name'], $params['object_id'] ) }}</li>
	<li>{{ link_to_route('admin.'.$params['route'].'.index', trans('admin_titles.'.$params['route'].'.titles'), [$params['object_type'], $params['object_id']] ) }}</li>
	<li class="active">{{ trans('admin_titles.adding') }} </li>
@endsection


@section('content')

	@include('admin.'.$params['route'].'.edit._form')

@endsection

@push('bottom')
	<script src="/js/admin/plugins/dropzone/dropzone.min.js" type="text/javascript"></script>

	<script>
		$(document).ready(function(){

			Dropzone.options.uploadPhoto = {
				acceptedFiles: 'image/jpeg,image/jpg,image/JPEG,image/JPG',
				parallelUploads: 1
			};

		});
	</script>
@endpush