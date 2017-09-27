@extends ('frontend.layouts.master')

@section ('content')
    <div class="content">

        <!-- CONTAINER -->
        <div class="slider container oneslider margin-top">
            <ul>
                <li>
                    <div class="container">
                        <div class="col-sm-3 col-sm-offset-2 text-center">
                            <img src="http://placehold.it/220x220" alt="" class="circle">
                        </div>
                        <div class="col-sm-5 col-xs-8 col-sm-offset-0 col-xs-offset-2 text-left">
                            <br>
                            <p>Dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since, when an unknown.</p>
                            <h4 class="black">Leticia Keith</h4>
                            <small>Sony Systems</small>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="container">
                        <div class="col-sm-3 col-sm-offset-2 text-center">
                            <img src="http://placehold.it/220x220" alt="" class="circle">
                        </div>
                        <div class="col-sm-5 col-xs-8 col-sm-offset-0 col-xs-offset-2 text-left">
                            <br>
                            <p>Dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since, when an unknown.</p>
                            <h4 class="black">Mellvin Ann</h4>
                            <small>Fibra Systems</small>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="container">
                        <div class="col-sm-3 col-sm-offset-2 text-center">
                            <img src="http://placehold.it/220x220" alt="" class="circle">
                        </div>
                        <div class="col-sm-5 col-xs-8 col-sm-offset-0 col-xs-offset-2 text-left">
                            <br>
                            <p>Dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since, when an unknown.</p>
                            <h4 class="black">Petra Kachek</h4>
                            <small>Panasonic Systems</small>
                        </div>
                    </div>
                </li>
            </ul>
            <div class="slidebar">
                <a href="#" class="arrow prev">
                    <i class="custom-icon custom-icon-arrow-prev"></i>
                </a>
                <a href="#" class="arrow next">
                    <i class="custom-icon custom-icon-arrow-next"></i>
                </a>
                <nav class="pagination"></nav>
            </div>
        </div>
        <!-- /.container -->

        <!-- CONTAINER -->
        <div class="highlight">
            <div class="container">
                <div class="row">
                    <div class="col-sm-4">
                        <h2>Отзывы наших клиентов</h2>
                        <p class="grey">Words from our clients</p>
                    </div>
                    <div class="col-sm-4">
                        @foreach ($reviews as $k => $item)
                            @if ($k%2 == 0)
                                <p>{{ $item->text }}</p>
                                <h4 class="black">{{ $item->person_name }}</h4>
                                <small>{{ $item->person_position }}, {{ $item->company }}</small>
                            @endif
                        @endforeach
                    </div>
                    <div class="col-sm-4">
                        @foreach ($reviews as $k => $item)
                             @if ($k%2 !== 0)
                            <p>{{ $item->text }}</p>
                            <h4 class="black">{{ $item->person_name }}</h4>
                            <small>{{ $item->person_position }}, {{ $item->company }}</small>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container -->
    </div>
@endsection