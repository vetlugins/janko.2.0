{{ HTML::form_field($item, 'name', 'Название', 'Название', $errors) }}
{{ HTML::form_field($item, 'url', 'Сылка', 'Сылка', $errors) }}

<div class="form-group">
    {{ Form::button('<i class="fa fa-check"></i>'.trans('admin_titles.item_save'), ['type' => 'submit', 'class' => 'btn button f-right btn-success']) }}
</div>