@section('head')

@endsection

<div class="col-md-8 form-horizontal" style="width:98%">
	{{ HTML::form_field($item, 'id_val', trans('admin_fields.param_id'),trans('admin_fields.param_id'), $errors) }}	
	{{ HTML::form_field($item, 'name', trans('admin_fields.param_name'),trans('admin_fields.param_name'), $errors) }}	
	{{ HTML::form_field($item, 'value', trans('admin_fields.param_value'),trans('admin_fields.param_value'), $errors) }}	
	<div class="form-group">
		{{ Form::button('<i class="fa fa-check"></i> '.trans('admin_titles.item_save'), ['type' => 'submit', 'class' => 'btn button f-right btn-success']) }} 		
	</div>
</div>