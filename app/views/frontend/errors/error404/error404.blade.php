<!DOCTYPE html>
<html class="page404">
@include('frontend.errors._includes.head')
<body>

<!-- Preloader -->
<div id="preloader">
    <div id="status">&nbsp;</div>
</div>

<!-- WRAPPER -->
<div class="wrapper">

    <!-- HEADER -->
    <header class="header centered">
        <div class="container htop">
            <div class="row text-center">
                <div class="logo">
                    <a href="/">{{ Param::obtain('site_name') }}</a>
                </div>
            </div>
        </div>
    </header>
    <!-- /.header -->

    <!-- CONTENT -->
    <div class="content container text-center">
        <div class="page-header">
            <h1>404 <small>Упс! Эта страница не найдена на нашем сайте</small></h1>
        </div>
        <a class="btn btn-primary" href="/">На главную</a>
    </div>
    <!-- /.content -->

</div>
<!-- /.wrapper -->

<!-- FOOTER -->
@include('frontend.errors._includes.footer')
<!-- /footer -->

</body>
</html>