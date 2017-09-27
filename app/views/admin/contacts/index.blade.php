@extends('admin.layout')

@section('breadcrumbs')
	<li>{{ link_to_route( $cur_lang_route.'admin', trans('admin_titles.main_title') ) }}<span>→</span></li>
	<li class="active">{{ trans('admin_titles.'.$params['route'].'.titles') }}</li>
@endsection

@section('header')
  
@endsection

@section('content')
	<a href="{{URL::route( $cur_lang_route.'admin.'.$params['route'].'.create')}}" class="btn button btn-primary btn-large btn-block">{{ HTML::icon('plus') }} {{ trans('admin_titles.'.$params['route'].'.add_title') }}</a>
	<ul class="content">
		@foreach ($items as $item)
			<li>
				{{ link_to_route( $cur_lang_route.'admin.'.$params['route'].'.edit', $item->name, ['id' => $item->id]) }}
				<div class="edit-block">														
					<a title="{{ trans('admin_titles.item_edit') }}" class="icon-edit" href="{{ URL::route( $cur_lang_route.'admin.'.$params['route'].'.edit', $item->id) }}">{{ HTML::icon('edit') }}</a>
					<a title="{{ trans('admin_titles.item_delete') }}" class="icon-cancel" href="{{ URL::route( $cur_lang_route.'admin.'.$params['route'].'.destroy', $item->id) }}" data-method="delete" data-confirm="{{ trans('admin_messages.'.$params['route'].'.to_delete') }}">{{ HTML::icon('times') }}</a>
				</div>
			</li>
		@endforeach
	</ul>	
	{{ $items->links() }}
@stop

