<!DOCTYPE html>
<html>
<head>
    @include('frontend.layouts._includes._head')
</head>
<body>

    @include('frontend.layouts._includes._preload')

<!-- WRAPPER -->
<div class="wrapper">

    <!-- HEADER -->
    <header class="header sides">
        <div class="container htop">
            @include('frontend.layouts._includes._htop')
        </div>

        <div class="hbottom right-pos">
            @include('frontend.layouts._includes._hbottom')
        </div>
    </header>
    <!-- /.header -->

    @yield ('content')

</div>

@include('frontend.layouts._includes._js')
</body>
</html>