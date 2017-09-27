@extends ( 'frontend.layouts.master' )

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
        <div class="container">
            <div class="row">
                <!-- POST -->
                <div class="col-xs-12 col-md-12 post" >{{ $page->full_text }}</div>
                <!-- /.post -->
            </div>
        </div>
        <!-- /.container -->
    </div>
    <!-- /.content -->

@overwrite