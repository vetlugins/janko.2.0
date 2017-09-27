@extends('frontend.layouts.master')
@section ('content')

    @if (isset($params['slides']) and count($params['slides']) )
        @include('frontend.layouts._slides_inner_page',['slides' => $params['slides'],'page' => $page])
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
                        <li><a href="{{URL::route('catalog.index')}}">Каталог</a></li>
                        <li><i class="fa fa-angle-right"></i></li>
                        <li><a href="{{URL::route('catalog.type',['url' => $page->rubric->type])}}">{{ $params['type'][$page->rubric->type] }}</a></li>
                        <li><i class="fa fa-angle-right"></i></li>
                        <li><a href="{{URL::route('catalog.url',['url' => $page->rubric->url])}}">{{ $page->rubric->title }}</a></li>
                        <li><i class="fa fa-angle-right"></i></li>
                        <li class="active">{{ $page->title}}</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- /.container -->

        <!-- CONTAINER: product -->
        <div class="container product padding-top">
            @if ( count($page->photos) > 0 )
                <!-- Product Gallery -->
                <div class="col-sm-6 product-gallery magnific-wrap">
                    <div class="img-medium text-center">
                        @if ( $page->old_cost > $page->cost )
                            <div class="sticker sticker-sale">sale</div>
                        @endif
                        @if ( $page->bestseller )
                            <div class="sticker sticker-top">хит</div>
                        @endif
                        @if ( $page->new )
                            <div class="sticker sticker-new">new</div>
                        @endif
                        <!-- Preview Slider -->
                        <div class="medium-slider">
                            @foreach ( $page->photos as $photo )
                                <a href="{{ $photo->image->url ( 'big1' ) }}" class="magnific"><img src="{{ $photo->image->url ( 'medium1' ) }}" alt=""></a>
                            @endforeach
                        </div>
                    </div>

                    <!-- Thumbs Slider -->
                    <div class="thumbs-wrap">
                        <a href="" class="th-prev th-arrow pull-left">
                            <i class="custom-icon custom-icon-arrow-prev"></i>
                        </a>
                        <a href="" class="th-next th-arrow pull-right">
                            <i class="custom-icon custom-icon-arrow-next"></i>
                        </a>
                        <div class="thwrap">
                            @if ( count($page->photos) > 0 )
                                <div class="thumbs-slider">
                                    @foreach ( $page->photos as $photo )
                                        <a href="{{ $photo->image->url ( 'medium1' ) }}" data-bigimg="{{ $photo->image->url ( 'big1' ) }}"><img src="{{ $photo->image->url ( 'small1' ) }}" alt=""></a>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @else
                <div class="col-sm-4">
                    @if( is_object($page->cover) && $page->cover->image_file_name !== NULL )
                        <img src="{{ $page->cover->image->url('original') }}" alt="">
                            @if ( $page->old_cost > $page->cost ) <div class="sticker sticker-sale">sale</div> @endif
                            @if ( $page->bestseller ) <div class="sticker sticker-top">хит</div> @endif
                            @if ( $page->new ) <div class="sticker sticker-new">new</div> @endif
                        @else
                            <img src="http://placehold.it/240x250" alt="">
                            @if ( $page->old_cost > $page->cost )<div class="sticker sticker-sale">sale</div>@endif
                            @if ( $page->bestseller )<div class="sticker sticker-top">хит</div>@endif
                            @if ( $page->new )<div class="sticker sticker-new">new</div>@endif
                        @endif
                </div>
            @endif
            <!-- /product gallery -->
            <div class="@if(count($page->photos) > 0) col-sm-6 @else col-sm-8 @endif">
                <div class="row">
                    <h2>{{ $page -> title }}</h2>
                    <p class="grey">{{ $page->sub_title}}</p>
                    <div class="cost">
                    	@if ( $page->old_cost > $page->cost )
                        <del>{{ $page -> old_cost }} руб.</del>
                        <span class="new">{{ $page -> cost }} руб.</span>
                        @else
                        <span>{{ $page -> cost }} руб.</span>
                        @endif
                    </div>
                </div>
                <div class="row goods-description" style="margin-top:0">
                    <p>{{ $page -> short_text }}</p>
                </div>
                <div class="row product-count">
                    <div class="counting col-xs-12 col-sm-3" style="padding: 0">
                        <a href="" class="a-less disabled" onclick="count_item( '#to_basket_count{{$page->id}}' , -1 );return false">-</a>
                        <input type="text" id="to_basket_count{{$page->id}}" value="1">
                        <a href="" class="a-more" onclick="count_item( '#to_basket_count{{$page->id}}' , 1 );return false">+</a>
                    </div>
                    <div class="col-xs-12 col-sm-9 cart-buttons"  style="padding: 0">
                        @if ( $page->in_basket )
                                <a href="" onclick="DelProductFromCart( {{ $page->id }} );return false;" class="btn btn-primary stroke add-cart item-removebutton-{{ $page->id }}" @if (!$page->in_basket) @endif> Убрать из корзины</a>
                            @else
                                <a class="btn btn-primary colored add-cart" id="show-item-add-cart" onclick="AddToBasket( {{ $page->id }}, $('#to_basket_count{{$page->id}}').val() );return false;" href="">Добавить в корзину</a>
                                <a href="" onclick="DelProductFromCart( {{ $page->id }} );return false;" class="btn btn-primary stroke add-cart item-removebutton-{{ $page->id }}" @if (!$page->in_basket) style="display:none;" @endif>Убрать</a>
                            @endif
                            <a class="btn btn-primary stroke" id="order-cart" @if ( !$page->in_basket ) style="display: none" @endif href="/cart">Оформить заказ</a>
                    </div>

                </div>
            </div>
        </div>
        <!-- /.container -->

        <!-- TABS -->
        <div class="tabs" style="margin: 0 !important;">
            <ul class="container nav nav-tabs">
                <li class="active"><a href="#description" data-toggle="tab"><span>Описание</span></a></li>
                <li><a href="#characteristics" data-toggle="tab"><span>Характеристики</span></a></li>
                <li><a href="{{URL::route('documents.index',['url' => 'ies'])}}" target="_blank"><span>IES</span></a></li>
                <li><a href="{{URL::route('documents.index',['url' => 'certificate'])}}" target="_blank"><span>Сертификаты</span></a></li>
                <li><a href="{{URL::route('documents.index',['url' => 'passports'])}}" target="_blank"><span>Паспорт</span></a></li>
            </ul>
            <div class="highlight">
                <div class="container tab-content">
                    <div class="tab-pane fade in active" id="description">
                        <div class="row" style="padding: 15px !important;">
                            @if(!empty($page->text)){{ $page->text }} @else Описание товара отсутствует @endif
                        </div>
                    </div>
                    <div class="tab-pane fade" id="characteristics">
                        <div class="row" style="padding: 15px !important;">
                            @if(!empty($page->characteristics)){{ $page->characteristics }} @else Характеристики товара отсутствует @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.tabs -->

@endsection