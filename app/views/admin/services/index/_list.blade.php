<li id="array_order_{{$item->id}}">

    <div class="item">

        <div class="pull-left" style="padding: 15px 0 0 10px">
            <a href="{{ URL::route('admin.'.$params['route'].'.edit',$item->id) }}"><strong>{{$item->title}}</strong></a>
        </div>

        <div class="pull-right padding-sm">
            <a title="Скрыть / Показать" class="hideShow btn {{ $item->visible ? 'btn-success' : 'btn-warning' }} btn-sm"  data-toggle="tooltip"  data-id="{{$item->id}}" data-action="{{ URL::route( 'admin.'.$params['route'].'.visibility') }}">
                <i class="fa {{ $item->visible ? 'fa-eye ' : 'fa-eye-slash' }}"></i>
            </a>

            <a href="{{ URL::route('admin.'.$params['route'].'.edit',$item->id) }}" class="btn btn-info btn-sm" title="Редактировать" data-toggle="tooltip">
                <i class="fa fa-edit"></i>
            </a>

            <a data-toggle="tooltip"
               class="btn btn-danger btn-sm"
               title="Удалить"
               href="{{ URL::route('admin.'.$params['route'].'.destroy', $item->id) }}"
               data-method="delete"
               data-confirm="{{ trans('admin_messages.'.$params['route'].'.to_delete') }}"
               >
                <i class="fa fa-trash-o"></i>
            </a>

        </div>

        <div class="clearfix"></div>

    </div>



</li>
