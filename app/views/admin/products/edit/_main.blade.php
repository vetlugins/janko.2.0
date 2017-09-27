<div class="box">

    <div class="box-title ">
        @if ( $edit_type == 'edit' )
            {{ HTML::icon('edit'); }} Редактирование
        @else
            {{ HTML::icon('plus'); }} Добавление
        @endif
    </div>
    <div class="box-body padding-md ">

        {{ HTML::form_field($item, 'title', trans('admin_fields.title'),trans('admin_fields.title'), $errors) }}

        {{ HTML::form_field($item, 'sub_title', trans('admin_fields.sub_title'),trans('admin_fields.sub_title'), $errors) }}

        <div class="form-group">

            {{ Form::label('', trans('admin_fields.content'), ['class' => 'col-sm-2 control-label']) }}

            <div class="col-sm-10">

                <ul class="nav nav-tabs">
                    <li class="active"><a href="#description_tab" data-toggle="tab">{{trans('admin_fields.preview')}}</a></li>
                    <li><a href="#opinion_tab" data-toggle="tab">Расширенное описание</a></li>
                    <li><a href="#characteristics_tab" data-toggle="tab">Характеристики</a></li>
                </ul>

                <div class="tab-content">
                      <div class="tab-pane active" id="description_tab">
                            {{ Form::textarea('preview', $item->preview, ['class' => 'form-control', 'id' => 'preview']) }}
                      </div>
                      <div class="tab-pane" id="opinion_tab">
                            {{ Form::textarea('text', $item->text, ['class' => 'form-control', 'id' => 'text']) }}
                      </div>
                      <div class="tab-pane" id="characteristics_tab">
                            {{ Form::textarea('text', $item->characteristics, ['class' => 'form-control', 'id' => 'characteristics']) }}
                      </div>
                </div>

            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                {{ Form::button('<span class="btn-label"><i class="fa fa-check"></i></span>'.trans('admin_titles.item_save'), ['type' => 'submit', 'class' => 'btn button f-right btn-success btn-labeled']) }}
            </div>
        </div>

        <div class="clearfix"></div>

    </div>

</div>


