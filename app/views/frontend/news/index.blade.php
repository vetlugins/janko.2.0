@extends ('frontend.layouts.master')

@section ('content')

    @if (isset($slides) and count($slides) )
        @include('frontend.layouts._slides_inner_page',['slides' => $slides,'page' => $page])
    @endif

    <!-- CONTENT -->
    <div class="content">

        <!-- CONTAINER -->
        <div class="container breadcrumbs">
            <div class="row">
                <div class="col-md-12">
                    <ol class="breadcrumb">
                        <li><a href="http://{{ Config::get('data.base_url') }}"><i class="fa fa-home"></i> Главная</a></li>
                        @define $breadcrumbs = $page->getParents($page->id)
                        @foreach($breadcrumbs as $value)
                            @if($value['id'] == $page->id)
                                <li><i class="fa fa-angle-right"></i></li>
                                <li class="active">{{$value['title']}}</li>
                                @break;
                            @else
                                <li><i class="fa fa-angle-right"></i></li>
                                <li><a href="{{$value['url']}}">{{$value['title']}}</a></li>
                            @endif
                        @endforeach
                    </ol>
                </div>
            </div>
        </div>
        <!-- /.container -->

        <!-- CONTAINER -->
        <div class="container" style="padding-bottom: 10px">

            <!-- MASONRY -->
            <div class="row masonry-list">

                @foreach ($news as $k => $item)
                    @if ( isset($simplePagination) && $simplePagination && $k == $simplePagination )
                        @break;
                    @endif

                <!-- post -->
                <div class="col-md-4 col-sm-6 post">
                    <p class="date grey">{{ date("d",strtotime($item->printDate('date'))) }} {{ $item->printRussianMonth('date') }}, {{ date("y",strtotime($item->printDate('date'))) }}</p>
                    @if( is_object($item->cover) && $item->cover->image_file_name !== NULL ) 
                    <p><a href="/{{$page->url}}/{{ $item->url }}"><img src="{{ $item->cover->image->url('thumb') }}" alt=""></a></p>
                    @endif
                    <h3><a href="/{{$page->url}}/{{ $item->url }}" class="black">{{$item->title}}</a></h3>
                    <p>{{$item->preview}}</p>
                </div>
                <!-- /.post -->
                @endforeach
            </div>
            <!-- /.row -->

            @if ( count($simplePagination) > 6 )
                <div class="container">
                    <div class="row">
                        <div class="col-md-7 col-sm-8">
                            <ul class="pagination">
                                {{ $news->appends( Input::query () )->links('frontend.pagination') }}
                            </ul>
                            <script>
                                $(document).ready(function() {
                                    $('.pagination a').first().html('<i class="custom-icon custom-icon-page-prev"></i>');
                                    $('.pagination a').last().html('<i class="custom-icon custom-icon-page-next"></i>');
                                    $('.pagination a.active').click(function(event) {
                                        event.preventDefault();
                                    });
                                });
                            </script>
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </div>
@endsection