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
                        <li><i class="fa fa-angle-right"></i></li>
                        <li><a href="{{URL::route('news.index')}}">Новости</a></li>
                        <li><i class="fa fa-angle-right"></i></li>
                        <li class="active">{{$page->title}}</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- /.container -->

        <!-- CONTAINER -->
        <div class="container">
                <!-- POST -->
                <div class="col-sm-12 post">
                    <h1>{{ $page->title }}</h1>
                    <p class="post-inf grey">
                        <span class="date">{{ date("d",strtotime($page->printDate('date'))) }} {{ $page->printRussianMonth('date') }}, {{ date("y",strtotime($page->printDate('date'))) }}</span>
                    </p>
                    <div>
                        @if( is_object($page->cover) && $page->cover->image_file_name !== NULL )      
                            <img src="{{ $page->cover->image->url('medium') }}" alt="">
                        @endif
                    </div>
                    <p>{{ $page->text }}</p>
                </div>
                <!-- /.post -->
        </div>
        <!-- /.container -->
    </div>
    <!-- /.content -->
@endsection