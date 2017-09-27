
<div class="form-horizontal">
	<div class="form-group">
		{{ Form::label('', 'Файлы', ['class' => 'col-sm-2 control-label']) }}
		<div class="col-sm-10">
			{{ Form::file('files[]', ['multiple','class' => 'btn btn-info file-inputs','title' => 'Выберите файлы для загрузки'] ) }}
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			{{ Form::button('<span class="btn-label"><i class="fa fa-check"></i></span> Загрузить', ['type' => 'submit', 'class' => 'btn f-right btn-success btn-labeled ']) }}
		</div>
	</div>
</div>
<div class="clearfix"></div>
