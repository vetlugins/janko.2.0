@section('head')

@endsection

<div class="col-md-8 form-horizontal">

  {{ HTML::form_field($item, 'name', trans('admin_fields.param_name'),trans('admin_fields.param_name'), $errors) }}	
  {{ HTML::form_field($item, 'type', trans('admin_fields.type'),trans('admin_fields.type'), $errors) }}	
	<div class="form-group">
	  <div class="col-sm-2"></div>
	  <div class="col-sm-10 btns">
		{{ Form::button('<i class="fa fa-check"></i> '.trans('admin_titles.item_save'), ['type' => 'submit', 'class' => 'btn button f-left btn-success']) }} 		
	  </div>
	</div>
</div>