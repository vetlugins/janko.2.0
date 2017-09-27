@extends('admin.layout')

@section('breadcrumbs')
	<li>{{ link_to_route('admin', trans('admin_titles.main_title') ) }}</li>
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
						Список пользователей
					</div>
					<div class="box-body no-padding">
						<table class="table table-striped">
							<tbody>
							@foreach ($items as $item)
							<tr>
								<td style="width: 70%"><a href="{{ URL::route ( 'admin.'.$params['route'].'.edit', $item->id ) }}">{{ $item->displayName() }}</a></td>
								<td style="width: 30%" class="text-right">
									<a class="btn btn-info btn-sm" title="{{ trans('admin_titles.item_edit') }}" href="{{ URL::route('admin.'.$params['route'].'.edit', $item->id) }}">
										<i class="fa fa-edit "></i>
									</a>
									<a class="btn btn-danger btn-sm" title="{{ trans('admin_titles.item_delete') }}" href="{{ URL::route('admin.'.$params['route'].'.destroy', $item->id) }}" data-method="delete" data-confirm="{{ trans('admin_messages.'.$params['route'].'.to_delete') }}">
										<i class="fa fa-trash-o "></i>
									</a>
								</td>
							</tr>
							@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
@endsection

