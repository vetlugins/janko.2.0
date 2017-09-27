@extends('admin.layout')

@section('head')

@endsection

@section('breadcrumbs')
  	<li>{{ link_to_route( 'admin', trans('admin_titles.main_title') ) }}</li>
	<li class="active">{{ trans('admin_titles.'.$params['route'].'.titles') }}</li>
@endsection

@section('header')

	<a href="{{URL::route('admin.'.$params['route'].'.create')}}" class="btn btn-labeled btn-success pull-right">
		<span class="btn-label">{{ HTML::icon('plus'); }}</span>{{ trans ( 'admin_titles.'.$params['route'].'.add_title' ) }}
	</a>

@endsection

@section('content')

		<!-- Main row -->
		<div class="row">
			<div class="col-lg-12">
				<div class="box">
					<div class="box-title">
						Список страниц
					</div>
					<div class="box-body no-padding">
						<ul class="itemsList list-drag-n-drop no-margin no-padding" data-action="{{ route('admin.'.$params['route'].'.structure') }}">
							@foreach ($items as $item)
								@include('admin.pages.index._list')
							@endforeach
						</ul>
					</div>
				</div>
			</div>
		</div>

@endsection

@section('bottom')

@endsection