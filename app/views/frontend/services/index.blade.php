@extends ('frontend.layouts.master')

@section ('content')

    @if (isset($slides) and count($slides) )
        @include('frontend.layouts._slides_inner_page',['slides' => $slides,'page' => $page])
    @endif
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
                <!-- .profile -->
                @foreach ($services as $item)
                <div class="row">
                    <div class="col-md-3">
                        @if ( is_object($item->cover) && $item->cover->image_file_name !== NULL )
                            <img src="{{ $item->cover->image->url('thumb') }}">
                        @else
                            <img src="http://www.placehold.it/220x220">
                        @endif
                    </div>
                    <div class="col-md-8">
                        <h3><a href="/about/services/{{ $item->url }}">{{ $item->title }}</a></h3>
                        <h5>{{ $item->preview }}</h5>
                    </div>
                </div>
                @endforeach

        </div>


 
@endsection