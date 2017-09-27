@extends ('frontend.layouts.master')

@section ('content')

        <div class="container faq padding-top">


            @if ( count($rubrics) )
                <div class="row">
                    <ul class="nav-category text-center">
                        <li><a href="#all" class="filter" data-filter="all">показать все<ins>&nbsp;</ins></a></li>
                        @foreach ($rubrics as $item)
                            <li><a href="#rubric{{ $item->id }}" class="filter" data-filter=".rubric{{ $item->id }}">{{ $item->title }}<ins>&nbsp;</ins></a></li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- row: faq -->
            <div class="container panel-group mix-list" id="faq">
                <!-- COL -->
                <div class="col-md-6">
                    @foreach ($faq as $k => $item)
                        @if ($k%2 == 0)
                            <div class="row mix rubric{{ $item->faqrubric_id }}">
                                <a href="#faq-{{ $item->id }}" class="accordeon-toggle"  data-parent="#faq" data-toggle="collapse">+</a>
                                <div class="accordeon-content">
                                    <h3 class="hand" data-parent="#faq"  data-target="#faq-{{ $item->id }}" data-toggle="collapse">{{ $item->question }}</h3>
                                    <div class="panel-body collapse" id="faq-{{ $item->id }}">
                                        <div class="highlight darker">
                                            <p>{{ $item->answer }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
                <!-- /.col -->

                <!-- COL -->
                <div class="col-md-6">
                     @foreach ($faq as $k => $item)
                        @if ($k%2 !== 0)
                            <div class="row mix rubric{{ $item->faqrubric_id }}">
                                <a href="#faq-{{ $item->id }}" class="accordeon-toggle"  data-parent="#faq" data-toggle="collapse">+</a>
                                <div class="accordeon-content">
                                    <h3 class="hand" data-parent="#faq"  data-target="#faq-{{ $item->id }}" data-toggle="collapse">{{ $item->question }}</h3>
                                    <div class="panel-body collapse" id="faq-{{ $item->id }}">
                                        <div class="highlight darker">
                                            <p>{{ $item->answer }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
@endsection