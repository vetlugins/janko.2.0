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

								<div class="col-lg-3">
									{{ Form::file('jdata[widget][fields][blocks]['.$i.'][slide]', ['class' => 'btn btn-info file-inputs','title' => 'Выберите файл'] ) }}
								</div>

								<div class="col-lg-2">
									<input type="text" class="form-control" name="jdata[widget][fields][blocks][{{$i}}][title]" placeholder="Название" value="{{ $item->jd("widget.fields.blocks.{$i}.title") }}">
								</div>

								<div class="col-lg-2">
									<input  type="text" class="form-control" name="jdata[widget][fields][blocks][{{$i}}][text]" placeholder="Описание" value="{{ $item->jd("widget.fields.blocks.{$i}.text") }}">
								</div>

								<div class="col-lg-2">
									<input  type="text" class="form-control" name="jdata[widget][fields][blocks][{{$i}}][url]" placeholder="Ссылка" value="{{ $item->jd("widget.fields.blocks.{$i}.url") }}">
								</div>

								<div class="col-lg-2">
									<div class="form-group">
										<div id="cp2" class="input-group colorpicker-component cp2">
											<input type="text" name="jdata[widget][fields][blocks][{{$i}}][color]" value="{{ $item->jd("widget.fields.blocks.{$i}.color") }}" placeholder="Цвет" class="form-control">
											<span class="input-group-addon"><i></i></span>
										</div>
									</div>
								</div>

							</div>
						@endfor

						<div class="form-group margin-top-lg">
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

	<script type="text/javascript" src="/js/admin/plugins/bootstrap-file-input/bootstrap-file-input.js"></script>

	<link rel="stylesheet" media="screen" type="text/css" href="/stylesheets/admin/colorpicker/colorpicker.css" />
	<script type="text/javascript" src="/js/admin/plugins/colorpicker/colorpicker.js"></script>

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

			//File Input
			$('.file-inputs').bootstrapFileInput();

			$('.cp2').colorpicker();
		});
	</script>
@endsection