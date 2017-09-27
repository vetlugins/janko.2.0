@extends('admin.layout')

@section('head')

@endsection

@section('breadcrumbs')
  	<li>{{ link_to_route( 'admin', trans('admin_titles.main_title') ) }}</li>

	<li class="active">Виджеты</li>
  
@endsection

@section('content')

		<!-- Main row -->
		<div class="row">
			<div class="col-lg-12">
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

@section('bottom')
	<script>
		$(document).ready(function(){

			$(function() {
				$(".list-drag-n-drop").sortable({tolerance: "pointer", opacity: 0.6, cursor: 'move', update: function() {

					var items = $(this).sortable("serialize");
					$.post("{{ URL::route('admin.'.$params['route'].'.structure') }}", items, function(theResponse){

					});
				}
				});
			});

		});
	</script>
@endsection