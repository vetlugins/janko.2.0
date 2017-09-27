{{ HTML::form_field($item, 'title', trans('admin_fields.title'),trans('admin_fields.title'), $errors) }}
{{ HTML::form_field($item, 'text', 'Текст', 'Текст', $errors) }}
{{ HTML::form_field($item, 'link', 'Ссылка', 'Ссылка', $errors) }}
{{ HTML::form_field($item, 'icon', 'Иконка', 'Иконка', $errors) }}

<div class="form-group">
    {{ Form::button('<i class="fa fa-check"></i>'.trans('admin_titles.item_save'), ['type' => 'submit', 'class' => 'btn button f-right btn-success']) }}
</div>