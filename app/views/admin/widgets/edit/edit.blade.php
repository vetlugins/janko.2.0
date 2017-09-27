@extends('admin.layout')

@section('breadcrumbs')
	<li>{{ link_to_route( 'admin', trans ( 'admin_titles.main_title' ) ) }}</li>
	<li>{{ link_to_route ('admin.'.$params['route'].'.index', 'Виджеты') }}</li>

	<li class="active">{{trans ( 'admin_titles.editing' ) }} "{{ $item->title }}" </li>

@endsection

@section('header')


@endsection

@section('content')

	<div class="row">
		<div class="col-lg-8">
			<div class="box">
				<div class="box-title">
					Виджеты лендинга
				</div>
				<div class="box-body no-padding">
					<ul class="itemsList list-drag-n-drop no-margin no-padding">
						@foreach ($items as $item)
							@include('admin.'.$params['route'].'.index._list')
						@endforeach
					</ul>
				</div>
			</div>
		</div>
	</div>

@endsection