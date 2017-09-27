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

        <div class="form-group">

            {{ Form::label('', trans('admin_fields.content'), ['class' => 'col-sm-2 control-label']) }}

            <div class="col-sm-10">

                <ul class="nav nav-tabs">
                    <li class="active"><a href="#short_text_tab" data-toggle="tab">{{trans('admin_fields.description')}}</a></li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane active" id="short_text_tab">
                        {{ Form::textarea('text', $item->text, ['class' => 'form-control', 'id' => 'text', 'style' => 'height: 300px']) }}
                    </div>
                </div>

            </div>

        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              {{ Form::button('<span class="btn-label"><i class="fa fa-check"></i></span>'.trans('admin_titles.item_save'), ['type' => 'submit', 'class' => 'btn button f-right btn-success btn-labeled']) }}
            </div>
        </div>
    </div>
</div>