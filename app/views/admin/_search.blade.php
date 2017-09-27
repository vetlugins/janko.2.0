{{ Form::model('', ['method' => 'get', 'class' => 'f-left form-control-search-form', 'route' => [ $cur_lang_route.'admin.'.$params['route'].'.search']]) }}
	{{ Form::text('query', '', ['id' => 'query', 'class' => 'form-control-search form-control', 'placeholder' => 'Введите часть названия или текста...' ]) }}
	{{ Form::button('<i class="fa fa-search"></i>'.trans('admin_titles.item_search'), ['type' => 'submit', 'class' => 'btn button mleft btn-success']) }}
{{ Form::close() }}
