@extends('frontend.layouts.master')


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

        <!--<div class="row">
            <div class="page-header col-sm-12">
                <h2>{{$page->title}}</h2>
            </div>
        </div>-->
        <!-- TABS -->
        <div class="tabs">
            <ul class="container nav nav-tabs text-center">
                @foreach($rubrics as $key=>$rubric)
                    <li  @if(isset($url) and $key == $url) class="active" @endif ><a href="{{ URL::route('documents.index',['url' => $key]) }}"><span>{{$rubric}}</span></a></li>
                @endforeach
            </ul>
            <div class="highlight">
                <div class="container tab-content">
                    @foreach($rubrics as $key=>$rubric)
                        <div class="tab-pane fade @if(isset($url) and $key == $url) in active @endif">
                            <div class="row">
                                @if(count($docs))
                                    <ul class="docs">
                                        @foreach($docs as $doc)
                                            <li>
                                                <a href="{{$doc->get_link()}}" target="_blank">
                                                    <img src="/images/icon/{{$doc->rubric}}.png" class="pull-left">
                                                    <div class="pull-left">
                                                        <h4>{{$doc->title}}</h4>
                                                        <p>
                                                            <span><i class="fa fa-clock-o"></i> {{$doc->created_at}}</span>
                                                            <span><i class="fa fa-file"></i> {{$doc->filename}}</span>
                                                        </p>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <h3 class="inherit">Документы не найдены</h3>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- /.tabs -->
    </div>
<!-- /.content -->

@endsection