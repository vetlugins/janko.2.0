<div class="form-group">
    <div class="col-lg-6">
        <label for="color_title">Название цвета</label>
        <input type="hidden" name="color_id" value="1">
        <input type="text" name="color_title" placeholder="Название цвета" id="color_title" class="form-control" >
    </div>
    <div class="col-lg-6">
        <div class="input-group">
            @if( $params['edit_type'] == 'edit' and $item->self_url == 'index')
                {{ Form::text('self_url', $item->self_url, ['class' => 'form-control', 'placeholder' => trans ( 'admin_fields.url' ),'disabled']) }}
            @else
                {{ Form::text('self_url', $item->self_url, ['class' => 'form-control', 'placeholder' => trans ( 'admin_fields.url' )]) }}
            @endif
            <span class="input-group-addon"><a href="{{ $item->getUrl() }}" target="_blank"><i class="fa fa-link"></i></a></span>
        </div>
        <label for="color_code">Код цвета</label>
        <input type="text" name="color_code" placeholder="Название цвета" value="" id="color_code" class="form-control">
    </div>
    <div class="clearfix"></div>
</div>

