<div class="box">
    <div class="box-title">
        <i class="fa fa-cogs"></i>
        <h3>{{ trans ( 'admin_fields.params' ) }}</h3>
        <div class="pull-right box-toolbar">
            <a href="#" class="btn btn-link btn-xs collapse-box"><i class="fa fa-chevron-up"></i></a>
        </div>
    </div>
    <div class="box-body" style="padding: 20px 45px">

        <div class="form-group checkbox check-success margin-bottom-md">
            {{ HTML::form_checkbox('visible', '', '<span></span>'.trans ( 'admin_fields.visible' ) , 1, $item->visible, $errors ) }}
        </div>

        <div class="form-group margin-bottom-md">
            {{ Form::label('self_url', trans ( 'admin_fields.url' )) }}

            <div class="input-group">
                @if( $params['edit_type'] == 'edit' and $item->self_url == 'index')
                    {{ Form::text('self_url', $item->self_url, ['class' => 'form-control', 'placeholder' => trans ( 'admin_fields.url' ),'disabled']) }}
                @else
                    {{ Form::text('self_url', $item->self_url, ['class' => 'form-control', 'placeholder' => trans ( 'admin_fields.url' )]) }}
                @endif
                <span class="input-group-addon"><a href="{{ $item->getUrl() }}" target="_blank"><i class="fa fa-link"></i></a></span>
            </div>
        </div>

        <div class="form-group margin-bottom-md">
            {{ Form::label('h1', trans ( 'admin_fields.h1' )) }}
            {{ Form::text('h1', $item->h1, ['class' => 'form-control', 'placeholder' => trans ( 'admin_fields.h1' )]) }}
        </div>

        <div class="form-group margin-bottom-md">
            {{ Form::label('h1_subtext', trans ( 'admin_fields.h1_subtext' )) }}
            {{ Form::text('h1_subtext', $item->h1_subtext, ['class' => 'form-control', 'placeholder' => trans ( 'admin_fields.h1_subtext' )]) }}
        </div>

        <div class="form-group margin-bottom-md">
            {{ Form::label('h1_color', 'Цвет заголовка страницы' ) }}

            <div id="cp2" class="color-title input-group">
                {{ Form::text('h1_color', $item->h1_color, ['class' => 'form-control', 'placeholder' => 'Цвет заголовка страницы']) }}
                <span class="input-group-addon"><i></i></span>
            </div>
        </div>

        <div class="form-group checkbox check-success margin-bottom-md">
            <div class="margin-bottom-xs no-padding">{{ Form::label('', 'Меню') }}</div>
            @foreach ( $menus as $menu_id => $menu_item )
                {{ HTML::form_checkbox('menu_item[]', 'menu_item'.$menu_id, '<span></span>'.$menu_item['name'], $menu_id, $menu_item['checked'], $errors ) }}<br/><br/>
            @endforeach
        </div>

        <div class="form-group">
            {{ Form::label('parent_id',  trans ( 'admin_fields.structure' ) ) }} ({{ trans ( 'admin_fields.parents_page' ) }})
            <select id="parent_id" name="parent_id" class="form-control">
                <option value="0">---</option>
                {{ $parents }}
            </select>
        </div>
    </div>
</div>

<div class="box">
    <div class="box-title">
        <i class="fa fa-bullhorn"></i>
        <h3>{{ trans ( 'admin_fields.seo' ) }}</h3>
        <div class="pull-right box-toolbar">
            <a href="#" class="btn btn-link btn-xs collapse-box"><i class="fa fa-chevron-down"></i></a>
        </div>
    </div>
    <div class="box-body collapse" style="padding: 20px 45px">

        <div class="form-group">
            {{ Form::label('page_title', trans ( 'admin_fields.page_title' )) }}
            {{ Form::text('page_title', $item->page_title, ['class' => 'form-control', 'placeholder' => trans ( 'admin_fields.page_title' )]) }}
        </div>
        <div class="form-group">
            {{ Form::label('page_description', trans ( 'admin_fields.page_description' )) }}
            {{ Form::textarea('page_description', $item->page_description, ['class' => 'form-control', 'placeholder' => trans ( 'admin_fields.page_description' ), 'rows' => '2']) }}
        </div>
        <div class="form-group">
            {{ Form::label('keywords', trans ( 'admin_fields.keywords' )) }}
            {{ Form::text('keywords', $item->keywords, ['class' => 'form-control', 'placeholder' => trans ( 'admin_fields.keywords' )]) }}
        </div>

    </div>
</div>