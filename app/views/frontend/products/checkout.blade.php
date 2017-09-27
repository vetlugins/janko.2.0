@extends('frontend.layouts.master')
@section ('content')

@if (isset($slides) and count($slides) )
    @include('frontend.layouts._slides_inner_page',['slides' => $slides,'page' => $page])
@endif


<!-- CONTENT -->
<div class="content">
    @if($basket['count'] == 0)
        <div class="container border-bottom text-center">
            <div class="row">
                <h3 class="inherit">Корзина пуста, вернуться к <a href="/catalog">Продукции</a></h3>
            </div>
        </div>
    @else
        <!-- container -->
        <div class="container border-bottom text-center">
            <div class="row">
                <h3 class="inherit">Спасибо, Ваш заказ успешно отправлен!</h3>
                <h4>В ближайшее время с Вами свяжется наш оператор.</h4>
            </div>
        </div>
        <!-- /.container -->

        <!-- CONTAINER: cart -->
        <div class="container cart">
            <!-- row -->
            <div class="row padding-bottom">
                <div class="col-sm-4">
                    <h3>Детали заказа</h3>
                    <p>Номер заказа № {{$data['id']}}<br>
                        {{$data['date']}}<br>
                        Сумма заказа {{$data['total_cost']}} <i class="fa fa-rub"></i>
                    </p>
                </div>
                <div class="col-sm-4">
                    <h3>Персональная информация</h3>
                    <p>{{$data['person_surname']}} {{$data['person_name']}} {{$data['person_patronymic']}}
                        <br>{{$data['person_email']}} <br>{{$data['person_phone']}}</p>
                </div>
                <div class="col-sm-4">
                    <h3>Информация о доставке</h3>
                    <p>Получатель: <strong>{{$data['person_surname']}} {{$data['person_name']}} {{$data['person_patronymic']}}</strong><br>
                        Адрес: <strong>@if(!empty($data['person_index'])) {{$data['person_index']}},@endif {{$data['person_town']}}, {{$data['person_address']}}</strong></p>
                </div>
            </div>
            <!-- /.row -->

            <!-- TABLE -->
            <div class="table-responsive">
                <table class="cart-table border-bottom">
                    <thead>
                    <tr>
                        <th>&nbsp;</th>
                        <th>Наименование</th>
                        <th>Цена</th>
                        <th>Количество</th>
                        <th>Итого</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(count($data['products_list']))
                        @foreach ( $data['products_list'] as $item )
                            <tr>
                                <td class="text-center">
                                    @if( is_object($item->cover) && $item->cover->image_file_name !== NULL )
                                        <a href="/catalog/{{ $item->url }}"><img src="{{ $item->cover->image->url ( 'small' ) }}" alt=""></a>
                                    @else
                                        <a href="/catalog/{{ $item->url }}"><img src="http://placehold.it/80x80" alt=""></a>
                                    @endif
                                </td>
                                <td class="td-descr">
                                    <a href="/catalog/{{ $item->url }}">{{ $item->title }}</a>
                                </td>
                                <td>
                                    <div class="cost">{{ $item->cost }}</div>
                                </td>
                                <td>{{ $item->pivot->amount }}</td>
                                <td>
                                    <div class="cost"><span>{{ $item->pivot->cost }}</span> <i class="fa fa-rub"></i></div>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
            <!-- /table -->

            <!-- row -->
            <div class="row">
                <div class="col-sm-4 col-sm-offset-8">
                    <h3 class="normal">Общий итог</h3>
                    <table class="cart-total">
                        <!--<tr>
                            <th>Cart Subtotal</th>
                            <td> {{$data['total_cost']}} <i class="fa fa-rub"></i></td>
                        </tr>
                        <tr>
                            <th>Shipping</th>
                            <td>Free Shipping</td>
                        </tr>-->
                        <tr>
                            <th>Сумма заказа</th>
                            <td> {{$data['total_cost']}} <i class="fa fa-rub"></i></td>
                        </tr>
                    </table>
                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container -->
    @endif
</div>
<!-- /.content -->


@endsection