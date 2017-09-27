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
                    <h3 class="inherit">Корзина пуста, вернуться раздел <a href="/catalog">Продукция</a></h3>
                </div>
            </div>
        @else
            <div class="container border-bottom text-center cart-no" style="display:none;">
                <div class="row">
                    <h3 class="inherit">Корзина пуста, вернуться к <a href="/catalog">Продукции</a></h3>
                </div>
            </div>
            <!-- CONTAINER: cart -->
            <div class="container tt cart">
                <!-- TABLE -->
                <div class="table-responsive">
                    <table class="cart-table border-bottom">
                        <thead>
                        <tr>
                            <th>&nbsp;</th>
                            <th>Товар</th>
                            <th>Цена</th>
                            <th>Количество</th>
                            <th>Общая сумма</th>
                            <th>&nbsp;</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ( $items as $item )
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
                                <td>
                                    <div class="counting inline-block">
                                        <a href="" class="a-less disabled" onclick="ChangeProductCartCount( {{ $item->id }}, -1 );return false">-</a>
                                        <span id="span_count{{ $item->id }}"><input type="text" value="{{ $item->count }}"></span>
                                        <a href="" class="a-more" onclick="ChangeProductCartCount( {{ $item->id }}, 1 );return false">+</a>
                                    </div>
                                </td>
                                <td>
                                    <div class="cost" id="total_cost{{ $item->id }}"><span class="el_total_cost{{ $item->id }}">{{ $item->cost * $item->count }}</span> рублей</div>
                                </td>
                                <td class="text-center">
                                    <a href="" onclick="DelProductFromCart( {{ $item->id }} );return false;" class="pclose small tr-remove"><i class="custom-icon custom-icon-close-s"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /table -->


                <!-- row -->
                <div class="row border-bottom">
                    <div class="col-md-4 col-sm-4">
                         <a href="" class="btn btn-primary colored btn-sm" style="margin-bottom:30px;">Обновить корзину</a>
                    </div>
                    <div class="col-md-4 col-sm-5 col-md-offset-4 col-sm-offset-3">
                        <h3 class="normal">Итого</h3>
                        <table class="product-table">
                            <tr>
                                <th>Сумма заказа</th>
                                <td class="cart-total-cost">@if ( $basket['cost'] ){{ output_numbers ( $basket['cost'] ) }}@endif</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <!-- /.row -->


        <!-- CONTENT -->
        <div class="content">

            <script>
                $(document).ready(function(){

                    $('#entity').hide();

                    $('#face').change(function(){

                        var face = $(this).val();

                        if(face == 'entity'){
                            $('#entity').slideToggle();
                            $('#person_inn').attr("required", "true");
                            $('#person_company').attr("required", "true");
                        }else{
                            $('#entity').slideUp();
                            $('#person_inn').removeAttr("required");
                            $('#person_company').removeAttr("required");
                        }

                    });

                });
            </script>

            <!-- CONTAINER: cart -->
            <div class="container cart">

                <!-- row -->
                <div class="row">
                    <h3 class="normal">Оформление заказа</h3>
                    <form method="post" action="/order/create" enctype="multipart/form-data">
                        <div class="col-sm-6">
                            <div class="formwrap">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <select data-width="100%" id="face">
                                            <option value="individual">Физическое лицо</option>
                                            <option value="entity">Юридическое лицо</option>
                                        </select>
                                    </div>
                                </div>
                                <div id="entity">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6" style="border: none; padding-right: 3px">
                                                <input type="text" name="person_inn" id="person_inn" placeholder="ИНН">
                                            </div>
                                            <div class="col-md-6" style="border: none">
                                                <input type="text" name="person_company"  id="person_company" placeholder="Компания">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6" style="border: none; padding-right: 3px">
                                            <input type="text" name="person_name" placeholder="Имя" required>
                                        </div>
                                        <div class="col-md-6" style="border: none">
                                            <input type="text" name="person_surname" placeholder="Фамилия" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="person_patronymic" placeholder="Отчество">
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6" style="border: none; padding-right: 3px">
                                            <input type="text" name="person_town" placeholder="Город">
                                        </div>
                                        <div class="col-md-6" style="border: none">
                                            <input type="text" name="person_index" placeholder="Индекс" >
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="person_address" placeholder="Адрес" required>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6" style="border: none; padding-right: 3px">
                                            <input type="email" name="person_email" placeholder="Email" required>
                                        </div>
                                        <div class="col-md-6" style="border: none">
                                            <input type="text" name="person_phone" placeholder="Телефон" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-default" id="send-order">Оформить заказ</button>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <textarea name="person_message" placeholder="Комментарий к заказу" style="height: 270px"></textarea>
                            </div>
                            <div class="form-group">
                                <input id="exampleInputFile" type="file" name="person_file">
                            </div>
                        </div>

                    </form>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container -->
        </div>
        <!-- /.content -->
    </div>
        @endif
<!-- /.wrapper -->


@endsection