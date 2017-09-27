
{{ HTML::form_field($items, 'email', 'Email', $items->email, $errors, 'email') }}
{{ HTML::form_field($items, 'name', 'Имя', $items->name, $errors) }}
{{ HTML::form_field($items, 'password', 'Пароль', null, $errors, 'password') }}
{{ HTML::form_field($items, 'password_confirmation', 'Подтвердите пароль', null, $errors, 'password') }}

<div class="form-group">
  <div class="col-sm-offset-2 col-sm-10">
    {{ Form::button('<span class="btn-label"><i class="fa fa-check"></i></span>'.trans('admin_titles.item_save'), ['type' => 'submit', 'class' => 'btn button f-right btn-success btn-labeled']) }}
  </div>
</div>

