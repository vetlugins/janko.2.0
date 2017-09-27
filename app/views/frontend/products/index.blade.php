@extends('frontend.layouts.master')
@section ('content')
    <script>
        console.log('products.index.blade.php');

        function getCookie(name) {
            var cookie = " " + document.cookie;
            var search = " " + name + "=";
            var setStr = null;
            var offset = 0;
            var end = 0;
            if (cookie.length > 0) {
                offset = cookie.indexOf(search);
                if (offset != -1) {
                    offset += search.length;
                    end = cookie.indexOf(";", offset)
                    if (end == -1) {
                        end = cookie.length;
                    }
                    setStr = unescape(cookie.substring(offset, end));
                }
            }
            return(setStr);
        };

        function setCookie (name, value, expires, path, domain, secure) {
            document.cookie = name + "=" + escape(value) +
                    ((expires) ? "; expires=" + expires : "") +
                    ((path) ? "; path=" + path : "") +
                    ((domain) ? "; domain=" + domain : "") +
                    ((secure) ? "; secure" : "");
        };

        function reload() {
            window.location.reload()
        }
    </script>

    @if (isset($params['slides']) and count($params['slides']) )
        @include('frontend.layouts._slides_inner_page',['slides' => $params['slides'],'page' => $page])
    @endif

    <!-- CONTENT -->
    <div class="content" style="padding: 0">

        <!-- CONTAINER -->
        <div class="container breadcrumbs">
            <div class="row">
                <div class="col-md-12">
                    <ol class="breadcrumb">
                        <li><a href="http://{{ Config::get('data.base_url') }}"><i class="fa fa-home"></i> Главная</a></li>
                        <li><i class="fa fa-angle-right"></i></li>
                        <li><a href="{{URL::route('catalog.index')}}">Каталог</a></li>
                        @if(!isset($category))
                            <li><i class="fa fa-angle-right"></i></li>
                            <li  class="active">{{ $params['type'][$type] }}</li>
                        @else
                            <li><i class="fa fa-angle-right"></i></li>
                            <li><a href="{{URL::route('catalog.type',['url' => $type])}}">{{ $params['type'][$type] }}</a></li>
                            <li><i class="fa fa-angle-right"></i></li>
                            <li class="active">{{ $category->title }}</li>
                        @endif
                    </ol>
                </div>
            </div>
        </div>
        <!-- /.container -->

        <!-- CONTAINER: catalog-square -->
        <div class="container catalog catalog-square" style="margin-top: 50px; padding: 0">

            @if(isMobile() and isset($url))
                <!-- catalog-content -->
                @include('frontend.products._list_product')
                <!-- /catalog-content -->

                <!-- catalog-bar -->
                @include('frontend.products._sidebar')
                <!-- /.catalog-bar -->
            @else
                <!-- catalog-bar -->
                @include('frontend.products._sidebar')
                <!-- /.catalog-bar -->

                <!-- catalog-content -->
                @include('frontend.products._list_product')
                <!-- /catalog-content -->
            @endif


        </div>
        <!-- /.container -->
    </div>
    <!-- /.content -->

@endsection