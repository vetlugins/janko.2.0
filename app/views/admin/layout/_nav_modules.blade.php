@foreach($items as $key => $module)

    @if($module['enabled'] == 1)

        <li class=" @if($params['route'] == $module['route']) active @endif @if(isset($module['sub'])) sub-nav @endif" >

            <a @if(!isset($module['sub'])) href="{{ route('admin.'.$module['route'].'.index') }}" @endif>
                <i class="fa fa-{{ $module['icon'] }}"></i> <span>{{ $module['title'] }}</span>
                @if(isset($module['sub']))<i class="fa fa-angle-right pull-right"></i>@endif
            </a>

            @if(isset($module['sub']))

                <ul class="sub-menu">

                    @foreach($module['sub'] as $item)

                        @if($item['enabled'] == 1)

                            <li>
                                <a href="{{ route('admin.'.$module['route'].'.index',$item['type']) }}">
                                    {{ $item['title'] }}
                                </a>
                            </li>

                        @endif

                    @endforeach

                </ul>

            @endif

        </li>

    @endif

@endforeach