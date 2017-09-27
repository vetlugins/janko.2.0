<!DOCTYPE html>
<html>
<head>
    @include('admin.layout._head')
    @yield('head')
</head>
<body class="fixed">
<!-- Header -->
<header>
    @include('admin.layout._header')
</header>
<!-- /.header -->

<!-- wrapper -->
<div class="wrapper">

    <div class="leftside">
        <div class="sidebar">
            @include('admin.layout._navigation')
        </div>
    </div>

    <div class="rightside">

        <div class="page-head">
            <h1>{{ $params['module'] }}</h1>
            <ol class="breadcrumb">
                <li>Вы здесь:</li>
                @yield('breadcrumbs')
            </ol>
        </div>

        <div class="content">

            <div class="row" style="margin-bottom: 30px">
                <div class="col-lg-12">
                    @if(Session::has('success') or Session::has('error'))
                        <div class="row-msg">
                            @if(Session::has('success'))
                                <div class="alert alert-success alert-dismissable">
                                    <button type="button" class="close cls" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    {{ date ( 'H:i' ) }}. {{ Session::get('success') }}
                                </div>
                            @endif
                            @if(Session::has('error'))
                                <div class="alert alert-danger alert-dismissable">
                                    <button type="button" class="close cls" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    {{ date ( 'H:i' ) }}. {{ Session::get('error') }}
                                    @foreach ( $errors->all() as $msg )
                                        {{ $msg }}
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    @endif
                </div>
                <div class="col-lg-12">@yield('header')</div>
            </div>

            @yield('content')
        </div>

    </div>

</div><!-- /.wrapper -->

@include('admin.layout._js')
@stack('bottom')

</body>
</html>