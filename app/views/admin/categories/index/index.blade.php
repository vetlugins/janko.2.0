@extends('admin.layout')

@section('head')

@endsection

@section('breadcrumbs')
  	<li>{{ link_to_route( 'admin', trans('admin_titles.main_title') ) }}</li>

	@if ( $params['parent_id'] )
		<li>{{ link_to_route ( 'admin.'.$params['route'].'.index', trans('admin_titles.'.$params['route'].'.titles') ) }}</li>
		@foreach ( $parents_nav as $i => $parent )
			@if ( $i != count ( $parents_nav ) - 1 )
				<li>{{ link_to_route( 'admin.'.$params['route'].'.show', $parent['title'], $parent['id'] ) }}</li>
			@else
				<li>{{ $parent['title'] }}</li>
			@endif
		@endforeach
	@else
		<li class="active">Категории каталога</li>
	@endif  
  
@endsection

@section('header')

	<a href="{{URL::route('admin.'.$params['route'].'.create')}}" class="btn btn-labeled btn-success pull-right">
		<span class="btn-label">{{ HTML::icon('plus'); }}</span> Добавить категорию
	</a>

@endsection

@section('content')

		<!-- Main row -->
		<div class="row">
			<div class="col-lg-12">
				<div class="box">
					<div class="box-title">
						Список категорий
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

@section('bottom')
	<script>
		$(document).ready(function(){

			$('.collapse-parent').click(function(b){
				b.preventDefault();
				var $box = $(this).parent('div').parent('div').parent('li').find('.parent');
				$box.slideToggle("slow");
			});

			$(function() {
				$(".list-drag-n-drop, .list-drag-n-drop .parent").sortable({tolerance: "pointer", opacity: 0.6, cursor: 'move', update: function() {

					var items = $(this).sortable("serialize");
					$.post("{{ URL::route('admin.'.$params['route'].'.structure') }}", items, function(theResponse){

					});
				}
				});
			});

		});
	</script>
@endsection