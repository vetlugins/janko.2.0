@extends ( 'frontend.layouts.master' )

@section('content')

    @if (isset($slides) and count($slides) )
        @include('frontend.layouts._slides_inner_page',['slides' => $slides,'page' => $page])
    @endif

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

        <div class="container">

            <div class="row">
                <div class="page-header col-sm-12">
                    <h2>Наши проекты</h2>
                </div>
            </div>

            <!-- CONTAINER: gallery -->
            <div class="gallery magnific-wrap no-padding ">
                <div class="row">
                    @foreach ($albums as $album)
                        <div class="col-md-4">
                            @if ( is_object($album->cover) )
                                <img src="{{ $album->cover->image->url('thumb') }}" alt="{{ $album->title }}">
                            @else
                                <img src="http://placehold.it/640x432" alt="">
                            @endif

                            <a href="{{ URL::route ( $cur_lang_route.'photos.index' ) }}/{{ $album->url }}" class="mask">
                                <h3>{{ $album->title }}</h3>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
            <!-- /.container -->

        </div>

    </div>
@endsection
