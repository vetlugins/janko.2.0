<div class="box">
    <div class="box-title">
        <i class="fa fa-cogs"></i>
        <h3>{{trans('admin_fields.cover')}}</h3>
        <div class="pull-right box-toolbar">
            <a href="#" class="btn btn-link btn-xs collapse-box"><i class="fa fa-chevron-up"></i></a>
        </div>
    </div>
    <div class="box-body" style="padding: 20px 45px">

        {{ View::make('admin.covers._form', ['cover' => $item->cover, 'type' => 'medium' ]) }}

    </div>
</div>

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
                @if( $params['edit_type'] == 'edit' and $item->url == 'index')
                    {{ Form::text('url', $item->url, ['class' => 'form-control', 'placeholder' => trans ( 'admin_fields.url' ),'disabled']) }}
                @else
                    {{ Form::text('url', $item->url, ['class' => 'form-control', 'placeholder' => trans ( 'admin_fields.url' )]) }}
                @endif
                <span class="input-group-addon"><a href="/services/{{ $item->url }}" target="_blank"><i class="fa fa-link"></i></a></span>
            </div>
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