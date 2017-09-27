@extends ( 'frontend.layouts.master' )

@section('content')
        <script>

            $(document).ready(function(){
                var url = document.location.href,
                    form = $('#send-form');

                form.submit(function(){

                    $(this).ajaxForm();

                    var values = $(this).serialize();

                    $(this).ajaxSubmit({
                        type: "POST",
                        url: "/mail/send",
                        data: values,
                        success: function(html){
                            $('#send-form').slideUp('slow',function(){
                                $(this).reset();
                            });
                            $('.success-msg').delay(1).slideDown('slow');
                        }
                    });

                    return false
                });


                var parser = document.createElement('a');

                parser.href = url;

                if(parser.hash != 'undefined' && parser.hash == '#send_letter'){

                    var destination = form.offset().top;
                    $("html:not(:animated),body:not(:animated)").animate({
                        scrollTop: destination - 200
                    }, 800);
                    return false;

                }
            });
        </script>

        <!-- HOME -->
<div class="home">
    <!-- ONESLIDER -->
    <div class="oneslider" style="height: 480px">
        <!-- CONTACT-map -->
        <div class="contact-map">
            <div id="map" style="width: 100%; height: 480px"></div>
        </div>
    </div>
    <!-- /.oneslider -->
</div>
<!-- /.home -->

    <!-- CONTENT -->
    <div class="content">

        <!-- HIGHLIGHT -->
        <div class="highlight">
            <div class="container">
                <div class="row">
                    <div class="col-md-5 col-sm-4">
                        <h2>Контакты</h2>
                        <p class="grey">ООО «ГК ВАРТЭ»</p>
                    </div>
                    <div class="col-md-3 col-sm-4">
                        @if ( isset( $contacts['address'] ) )<p style="margin-bottom: 0">{{ $contacts['address'] }}</p> @endif
                    </div>
                    <div class="col-sm-4">
                        <table class="description-table">
                            <tr>
                                <th>Телефон</th>
                                <td><span class="color">{{ $contacts['phone'] }}</span></td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td><a href="mailto:{{ $contacts['mail']  }}">{{ $contacts['mail']  }}</a></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.highlight -->

        <!-- CONTAINER -->
        <div class="container margin-top-0  padding-top-0">
            <div class="row">
                <div class="col-sm-4">
                    {{ $page->full_text }}
                </div>
                <div class="col-sm-7 col-sm-offset-1">
                    <div class="col-md-10 col-md-offset-1 bg-info box-inline success-msg" style="padding-top: 25px; background-color: #824994; display: none">
                        <div class="icon icon-extra-small icon-bubble-comment-streamline-talk"></div>
                        <h2><small>Письмо успешно отправлено</small></h2>
                        <!--<a href="" class="pull-right close-box">
                            <i class="custom-icon-lightclose-w"></i>
                        </a>-->
                    </div>
                    <form method="post" id="send-form" enctype="multipart/form-data">
                        <div class="formwrap">
                            <div class="form-group">
                                <input type="text" name="name" id="send-form-name" placeholder="Ваше имя" required>
                            </div>
                            <div class="form-group">
                                <input type="email" name="email" id="send-form-email" placeholder="Ваш email" required>
                            </div>
                            <div class="form-group">
                                <input type="text" name="phone" id="send-form-phone" placeholder="Ваш телефон">
                            </div>
                            <div class="form-group">
                                <input type="text" name="subject" id="send-form-subject" placeholder="Тема письма">
                            </div>
                            <!--<div class="form-group">
                                <select name="email_to" data-width="100%">
                                    <option value="info@varte.org">Общие вопросы</option>
                                    <option value="buhgalter@varte.org">Бухгалтерия</option>
                                    <option value="teh.otdel@varte.org">Технический отдел</option>
                                    <option value="menedger@varte.org">Отдел продаж</option>
                                </select>
                            </div>-->
                            <div class="form-group">
                                <textarea name="msg" placeholder="{{ $local['message'] }}" id="send-form-message" rows="35" required></textarea>
                            </div>
                            <div class="form-group" style="margin-bottom: 20px">
                                <input id="exampleInputFile" type="file" name="file">
                            </div>
                        </div>
                        <button class="btn btn-primary stroke btn-wd " type="submit" id="sendForm">{{ $local['send'] }}</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- /.container -->

        <!-- CONTAINER -->
        <div class="container margin-top-0 padding-top-0">

            <div class="row">
                <div class="col-sm-12"><h2>Реквизиты</h2></div>
                <div class="clearfix"></div>
                <div class="row requisites" style="margin-top: 15px !important;">
                    <div class="col-sm-4 col-xs-12">
                        <p><b>Полное наименование организации</b></p>
                    </div>
                    <div class="col-sm-8 col-xs-12">
                        <p>Общество с ограниченной ответственностью «Группа компаний Высокие Актуальные Развивающиеся Технологии Энергетики»</p>
                    </div>
                </div>
                <div class="row requisites">
                    <div class="col-sm-4 col-xs-12">
                        <p><b>Краткое наименование организации</b></p>
                    </div>
                    <div class="col-sm-8 col-xs-12">
                        <p>ООО «ГК ВАРТЭ»</p>
                    </div>
                </div>
                <div class="row requisites">
                    <div class="col-sm-4 col-xs-12">
                        <p><b>Юр. Факт. адрес организации</b></p>
                    </div>
                    <div class="col-sm-8 col-xs-12">
                        <p>248033. г. Калуга ул. 2-й Академический проезд, д.25</p>
                    </div>
                </div>
                <div class="row requisites">
                    <div class="col-sm-4 col-xs-12">
                        <p><b>ИНН / КПП</b></p>
                    </div>
                    <div class="col-sm-8 col-xs-12">
                        <p>4027126833 / 402701001</p>
                    </div>
                </div>
                <div class="row requisites">
                    <div class="col-sm-4 col-xs-12">
                        <p><b>ОГРН</b></p>
                    </div>
                    <div class="col-sm-8 col-xs-12">
                        <p>1154027004515</p>
                    </div>
                </div>
                <div class="row requisites">
                    <div class="col-sm-4 col-xs-12">
                        <p><b>Наименование банка</b></p>
                    </div>
                    <div class="col-sm-8 col-xs-12">
                        <p>Филиал АКБ «ФОРА-БАНК» в г. Калуга</p>
                    </div>
                </div>
                <div class="row requisites">
                    <div class="col-sm-4 col-xs-12">
                        <p><b>Корр. счет</b></p>
                    </div>
                    <div class="col-sm-8 col-xs-12">
                        <p>№ 30101810000000000770</p>
                    </div>
                </div>
                <div class="row requisites">
                    <div class="col-sm-4 col-xs-12">
                        <p><b>БИК</b></p>
                    </div>
                    <div class="col-sm-8 col-xs-12">
                        <p>042908770</p>
                    </div>
                </div>
                <div class="row requisites last">
                    <div class="col-sm-4 col-xs-12">
                        <p><b>Расчетный счет</b></p>
                    </div>
                    <div class="col-sm-8 col-xs-12">
                        <p>40702810500010005296</p>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.container -->

    </div>
    <!-- /.content -->

<script src="http://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
<script>

    var myMap;

    ymaps.ready(function () {
                myMap = new ymaps.Map('map', {
                    center: [{{ $contacts['latitude']  }}, {{ $contacts['longitude']  }}],
                    zoom: 16,
                    controls: ['zoomControl', 'fullscreenControl']
                }, {
                    searchControlProvider: 'yandex#search'
                });

                myMap.behaviors.disable('scrollZoom');

                myPlacemark = new ymaps.Placemark([{{ $contacts['latitude']  }}, {{ $contacts['longitude']  }}], {
                    hintContent: '<b style="color:#000; padding:15px 10px 0 10px">{{ $contacts['address'] }}</b>',
                    balloonContent: '<b style="color:#000; padding:15px 10px 0 10px">{{ $contacts['address'] }}</b>'
                }, {
                    iconLayout: 'default#image',
                    iconImageHref: '/images/icon/map-marker.png',
                    iconImageSize: [59, 85],
                    iconImageOffset: [-30, -90]
                });

        myMap.geoObjects.add(myPlacemark);
        myMap.behaviors.get('drag').disable()
    });

</script>

@endsection