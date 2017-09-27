@extends('admin.layout')

@section('breadcrumbs')
	@include('admin.widgets._includes._breadcrumbs')
@endsection

@section('header')


@endsection

@section('content')

	<div class="row">

		{{ Form::model($item, ['method' => 'put', 'route' => ['admin.'.$params['route'].'.update', $item->id], 'files' => true,'class' => 'form-horizontal']) }}

			<div class="col-lg-8">
				<div class="box">
					<div class="box-title">
						{{ $item->title }}
					</div>
					<div class="box-body">

						@for($i = 0; $i < 4; $i++)
						<div class="form-group ">

							<div class="col-lg-4">
								{{ Form::label('', 'Цифра', ['class' => 'control-label']) }}
								<input type="number" class="form-control" name="jdata[widget][fields][blocks][{{$i}}][number]" placeholder="Цифра" value="{{ $item->jd("widget.fields.blocks.{$i}.number") }}">
							</div>

							<div class="col-lg-4">
								{{ Form::label('', 'Название', ['class' => 'control-label']) }}
								<input type="text" class="form-control" name="jdata[widget][fields][blocks][{{$i}}][title]" placeholder="Название" value="{{ $item->jd("widget.fields.blocks.{$i}.title") }}">
							</div>

							<div class="col-lg-4">
								{{ Form::label('', 'Описание', ['class' => 'control-label']) }}
								<input  type="text" class="form-control" name="jdata[widget][fields][blocks][{{$i}}][text]" placeholder="Описание" value="{{ $item->jd("widget.fields.blocks.{$i}.text") }}">
							</div>

						</div>
						@endfor

						<div class="form-group">
							<div class="col-sm-12">
								{{ Form::button('<span class="btn-label"><i class="fa fa-check"></i></span>'.trans('admin_titles.item_save'), ['type' => 'submit', 'class' => 'btn button f-right btn-success btn-labeled']) }}
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-lg-4">
				@include('admin.widgets._includes._sidebar')
			</div>

		{{ Form::close() }}

	</div>

@endsection

@section('bottom')

	<script src="/js/admin/plugins/bootstrapValidator/bootstrapValidator.min.js" type="text/javascript"></script>
	<link rel="stylesheet" href="/stylesheets/admin/bootstrapValidator/bootstrapValidator.min.css" />

	<script type="text/javascript">
		$(document).ready(function(){

			//iCheck
			$(".check-success").iCheck({
				checkboxClass: 'icheckbox_square-green',
				radioClass: 'iradio_square-green'
			});

			/*$('#form-std').bootstrapValidator({
				message: 'Это значение недействительно',
				fields: {
					title: {
						message: 'Введите название страницы',
						validators: {
							notEmpty: {
								message: 'Введите название страницы'
							}
						}
					}
				}
			});*/
		});
	</script>
@endsection