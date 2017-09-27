<div class="col-sm-4 col-xs-12 catalog-bar" style="margin-top: -13px">
    <!-- widget -->
    <div class="widget" style="padding: 0">
        <div class="panel-group" id="accordion">
            @foreach($params['type'] as $key => $value)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title" style="font-weight: bold">
                            <a href="{{URL::route('catalog.type',['url' => $key])}}">{{$value}} <span class="badge pull-right color-background-444" style="padding: {{setPaddingBounce($params['totals'][$key])}}">{{ $params['totals'][$key] }}</span></a>
                        </h4>
                    </div>
                    <div class="panel-collapse collapse @if($type == $key)in @endif">
                        <div class="panel-body" style="padding: 12px 0;" >
                            <nav>
                                <ul>
                                    @foreach ($params['categories'][$key] as $k => $rubric)
                                        <li><a href="{{URL::route('catalog.url',['url' => $rubric->url])}}" @if(isset($url) and $url == $rubric->url) class="color" @endif>{{ $rubric->title }} <span class="badge pull-right color-background-ccc" style="margin-top: 3px; padding: {{setPaddingBounce($rubric->objects()->count())}}">{{ $rubric->objects()->count() }}</span></a></li>
                                        @foreach ($rubric->rubrics as $k => $subrubric)
                                            <li style="padding-left: 20px !important;"><a href="{{URL::route('catalog.url',['url' => $subrubric->url])}}">{{ $subrubric->title }} <span class="badge pull-right color-background-ccc" style="padding: {{setPaddingBounce($rubric->objects()->count())}}">{{ $rubric->objects()->count() }}</span></a></li>
                                        @endforeach
                                    @endforeach
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <!-- /.widget -->
    <!-- widget -->
    <div class="widget">
        <h4 class="black">Цена</h4>
        <input type="range" class="jslider" name="price" value="{{$min_range}};{{$max_range}}">

        <a onclick="return false" class="btn btn-filter btn-primary btn-sm stroke" style="margin: 10px auto">Сортировать</a>

        <script type="text/javascript">
            var min_cost = {{ $min_cost}};
            var max_cost = {{ $max_cost}};

            $(document).ready(function(){
                $('.btn-filter').click(function(){
                    min_range = $('.jslider-value:eq(0) span').text();
                    max_range = $('.jslider-value:eq(1) span').text();
                    max_range_length = max_range.length;
                    for(var i= 0, max_range_length; i<max_range_length; i++){
                        if ( max_range[i] === '–') {
                            max_range = max_range.substring(i+2);
                        }
                    }
                    setCookie('min_range', min_range);
                    setCookie('max_range', max_range);
                    setTimeout(reload,300);
                })
            })
        </script>
    </div>
    <!-- /.widget -->

</div>