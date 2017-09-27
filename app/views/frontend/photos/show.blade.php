@extends ( 'frontend.layouts.master' )

@section('content')
    @if (isset($slides) and count($slides) )
        @include('frontend.layouts._slides_inner_page',['slides' => $slides,'page' => $page])
    @endif
    <div class="content ">

        <!-- CONTAINER -->
        <div class="container breadcrumbs">
            <div class="row">
                <div class="col-md-12">
                    <ol class="breadcrumb">
                        <li><a href="http://{{ Config::get('data.base_url') }}"><i class="fa fa-home"></i> Главная</a></li>
                        <li><i class="fa fa-angle-right"></i></li>
                        <li><a href="{{URL::route('photos.index')}}">Фотогалерея</a></li>
                        <li><i class="fa fa-angle-right"></i></li>
                        <li class="active">{{$album->title}}</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- /.container -->

        <div class="container">

            <div class="row">
                <div class="page-header col-sm-12">
                    <h2>{{ $album->title }}</h2>
                </div>
            </div>

            <!-- CONTAINER: gallery -->
            <div class="gallery magnific-wrap no-padding">
                <div class="row">
                    @foreach ($album->photos as $k => $item)
                        <div class="col-md-3">
                            <img src="{{ $item->image->url ( 'thumb' ) }}" alt="{{ $album->title }}">
                            <a href="{{ $item->image->url ( 'big' ) }}" title="{{ $album->title }}" class="magnific mask">
                                <h3>{{ $album->title }}</h3>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- /.container

            <div class="row">
                <div class="page-header col-md-12 col-sm-12 padding-top">
                    <div class="text-right">
                        <button class="btn btn-primary stroke rounded  block btn-validation" onclick="history.back()">вернуться назад</button>
                    </div>
                </div>
            </div>-->

        </div>




    </div>
@endsection
