<li id="array_order_{{$item->id}}">

    <div class="item">

        <div class="pull-left" style="padding: 15px 0 0 10px">
            <a class="btn btn-default btn-xs collapse-box"><i class="fa @if(count($item->subPages)) fa-chevron-down @endif"></i></a>
            <a href="{{ route('admin.'.$params['route'].'.edit',$item->id) }}"><strong>{{$item->title}}</strong></a> @if($item->url == 'index') <a href="{{ route('admin.'.$params['route'].'.edit',$item->id) }}">[ Лэндинг ]</a> @endif
        </div>

        <div class="pull-right padding-sm">
            <a title="Скрыть / Показать" class="hideShow btn {{ $item->visible ? 'btn-success' : 'btn-warning' }} btn-sm"  data-toggle="tooltip"  data-id="{{$item->id}}" data-action="{{ route( 'admin.'.$params['route'].'.visibility') }}">
                <i class="fa {{ $item->visible ? 'fa-eye ' : 'fa-eye-slash' }}"></i>
            </a>

            <a href="{{ route('admin.'.$params['route'].'.edit',$item->id) }}" class="btn btn-info btn-sm" title="Редактировать" data-toggle="tooltip">
                <i class="fa fa-edit"></i>
            </a>

            <a data-toggle="tooltip"
               @if($item->url == 'index' or count($item->subPages))
                   title="Удалить нельзя"
                   class="btn btn-default btn-sm"
               @else
                   class="btn btn-danger btn-sm"
                   title="Удалить"
                   href="{{ route('admin.'.$params['route'].'.destroy', $item->id) }}"
                   data-method="delete"
                   data-confirm="{{ trans('admin_messages.'.$params['route'].'.to_delete') }}"
               @endif
               >
                <i class="fa fa-trash-o"></i>
            </a>

        </div>

        <div class="clearfix"></div>

    </div>

    @if(count($item->subPages))

        <ul class="list-drag-n-drop collapse box-body no-padding">
            @foreach($item->subPages as $children)
                <li id="array_order_{{$children->id}}">
                    <div class="item">
                        <div class="pull-left" style="padding: 15px 0 0 10px">
                            <a href="{{ route('admin.'.$params['route'].'.edit',$children->id) }}"><strong>{{ $children->title }}</strong></a>
                        </div>
                        <div class="pull-right padding-sm">
                            <a title="Скрыть / Показать" class="hideShow btn {{ $children->visible ? 'btn-success' : 'btn-warning' }} btn-sm vis {{ $children->visible ? 'vis1' : 'vis0' }}"  data-toggle="tooltip"  data-id="{{$children->id}}" data-action="{{ route( 'admin.'.$params['route'].'.visibility') }}">
                                <i class="fa {{ $children->visible ? 'fa-eye ' : 'fa-eye-slash' }}"></i>
                            </a>
                            <a href="{{ route('admin.'.$params['route'].'.edit',$children->id) }}" class="btn btn-info btn-sm" title="Редактировать" data-toggle="tooltip">
                                <i class="fa fa-edit"></i>
                            </a>
                            <a class="btn btn-danger btn-sm" title="Удалить" data-toggle="tooltip" href="{{ route('admin.'.$params['route'].'.destroy', $children->id) }}" data-method="delete" data-confirm="{{ trans('admin_messages.'.$params['route'].'.to_delete') }}">
                                <i class="fa fa-trash-o"></i>
                            </a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </li>
            @endforeach
        </ul>

    @endif

</li>
