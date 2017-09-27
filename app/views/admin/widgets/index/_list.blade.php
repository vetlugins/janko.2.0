<li id="array_order_{{$item->id}}">

    <div class="item">

        <div class="pull-left" style="padding: 15px 0 0 10px">
            <a href="{{ URL::route('admin.'.$params['route'].'.edit',$item->type) }}"><strong>{{$item->title}}</strong></a>
        </div>

        <div class="pull-right padding-sm">
            <a title="Скрыть / Показать" class="hideShow btn {{ $item->visible ? 'btn-success' : 'btn-warning' }} btn-sm"  data-toggle="tooltip"  data-id="{{$item->id}}" data-action="{{ URL::route( 'admin.'.$params['route'].'.visibility') }}">
                <i class="fa {{ $item->visible ? 'fa-eye ' : 'fa-eye-slash' }}"></i>
            </a>

            <a href="{{ URL::route('admin.'.$params['route'].'.edit',$item->type) }}" class="btn btn-info btn-sm" title="Редактировать" data-toggle="tooltip">
                <i class="fa fa-edit"></i>
            </a>

        </div>

        <div class="clearfix"></div>

    </div>

</li>
