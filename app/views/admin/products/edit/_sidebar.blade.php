<div class="box">
    <div class="box-title">
        <i class="fa fa-image"></i>
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
            <span style="margin-right: 20px">{{ HTML::form_checkbox('visible', '', '<span></span>'.trans ( 'admin_fields.visible' ) , 1, $item->visible, $errors ) }}</span>
            <span style="margin-right: 20px">{{ HTML::form_checkbox('hit', '', '<span></span> Хит' , 1, $item->hit, $errors ) }}</span>
            <span>{{ HTML::form_checkbox('new', '', '<span></span> Новинка', 1, $item->new, $errors ) }}</span>
        </div>

        <div class="form-group">
            <div class="col-lg-6 no-padding">
                <label>Цена</label>
                <input name="price" step="0.01" min="0.01" type="number" placeholder="Цена" class="form-control">
            </div>
            <div class="col-lg-6 no-padding">
                <label>Старая цена</label>
                <input name="price_old" step="0.01" min="0.01" type="number" placeholder="Старая цена" class="form-control">
            </div>
            <div class="clearfix"></div>
        </div>

        <div class="form-group">
            {{ Form::label('sku', 'Артикул') }}
            {{ Form::text('sku', $item->sku, ['class' => 'form-control', 'placeholder' => 'Артикул']) }}
        </div>

        <div class="form-group">
            <label>Количество в наличии</label>
            <input name="in_stock" step="1" min="1" type="number" placeholder="Количество в наличии" class="form-control">
        </div>

        <div class="form-group">
            {{ Form::label('category_id', 'Категория') }}
            <select class="form-control">
                @foreach($categories as $category)
                    @if(!count($category->parents))
                        <option value="{{ $category->id }}">{{ $category->title }}</option>
                    @else
                        <optgroup label="{{ $category->title }}">
                            @foreach($category->parents as $sub)
                                <option value="{{ $sub->id }}">{{ $sub->title }}</option>
                            @endforeach
                        </optgroup>
                    @endif
                @endforeach
            </select>
        </div>

    </div>
</div>

<div class="box">
    <div class="box-title">
        <i class="fa fa-filter"></i>
        <h3>Фильтры</h3>
        <div class="pull-right box-toolbar">
            <a href="#" class="btn btn-link btn-xs collapse-box"><i class="fa fa-chevron-down"></i></a>
        </div>
    </div>
    <div class="box-body collapse" style="padding: 20px 45px">



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

        <div class="form-group margin-bottom-md">
            {{ Form::label('self_url', trans ( 'admin_fields.url' )) }}

            <div class="input-group">
                @if( $edit_type == 'edit' and $item->url == 'index')
                    {{ Form::text('url', $item->url, ['class' => 'form-control', 'placeholder' => trans ( 'admin_fields.url' ),'disabled']) }}
                @else
                    {{ Form::text('url', $item->url, ['class' => 'form-control', 'placeholder' => trans ( 'admin_fields.url' )]) }}
                @endif
                <span class="input-group-addon"><a href="/services/{{ $item->url }}" target="_blank"><i class="fa fa-link"></i></a></span>
            </div>
        </div>

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