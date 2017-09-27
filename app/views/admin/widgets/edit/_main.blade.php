<div class="box">
    <div class="box-title ">
        @if ( $params['edit_type'] == 'edit' )
            {{ HTML::icon('edit'); }} Редактирование
        @else
            {{ HTML::icon('plus'); }} Добавление
        @endif
    </div>
    <div class="box-body padding-md ">
        {{ HTML::form_field($item, 'title', trans('admin_fields.title'),trans('admin_fields.title'), $errors) }}

        {{ HTML::form_field($item, 'icon', 'Иконка','Иконка', $errors) }}

        <div class="form-group">

            {{ Form::label('', trans('admin_fields.content'), ['class' => 'col-sm-2 control-label']) }}

            <div class="col-sm-10">

                <ul class="nav nav-tabs">
                    <li class="active"><a href="#full_text_tab" data-toggle="tab">{{trans('admin_fields.full_text')}}</a></li>
                    <li><a href="#short_text_tab" data-toggle="tab">{{trans('admin_fields.description')}}</a></li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane active" id="full_text_tab">
                        {{ Form::textarea('full_text', $item->full_text, ['class' => 'form-control', 'id' => 'full_text']) }}
                    </div>
                    <div class="tab-pane" id="short_text_tab">
                        {{ Form::textarea('short_text', $item->short_text, ['class' => 'form-control', 'id' => 'short_text']) }}
                    </div>
                </div>

            </div>

        </div>

        @if ($item->self_url == 'index')
            <div class="form-group">
                {{ Form::label('', 'SEO-текст, третья колонка', ['class' => 'col-sm-2 control-label', 'style' => 'margin-top:10px;' ]) }}
                <div class="col-sm-10">
                    {{ Form::textarea('seo', $item->seo, ['class' => 'form-control', 'id' => 'seo', 'style' => 'margin-top:10px;height:100px;resize:none;' ]) }}
                </div>
            </div>
        @endif

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              {{ Form::button('<span class="btn-label"><i class="fa fa-check"></i></span>'.trans('admin_titles.item_save'), ['type' => 'submit', 'class' => 'btn button f-right btn-success btn-labeled']) }}
            </div>
        </div>
    </div>
</div>