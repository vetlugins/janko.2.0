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
            <label for="jdata[widget][fields][title]" class="control-label">Название блока</label>
            <input type="text" class="form-control" name="jdata[widget][fields][title]" placeholder="Название блока" value="{{ $item->jd('widget.fields.title') }}">
            <p class="help-block">Название (если оно предусмотрено шаблоном) будет отображено в соответсвующем блоке на лендинге</p>
        </div>

        <div class="form-group margin-bottom-md">
            <label for="jdata[widget][fields][text]" class="control-label">Описание блока</label>
            <input type="text" class="form-control" name="jdata[widget][fields][text]" placeholder="Описание блока" value="{{ $item->jd('widget.fields.text') }}">
            <p class="help-block">Описание (если оно предусмотрено шаблоном) будет отображено под названием в соответсвующем блоке на лендинге</p>
        </div>

    </div>
</div>