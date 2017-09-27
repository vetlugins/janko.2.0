<div class="col-sm-8 col-xs-12">
    <p style="display:none;">{{ $counter = 0; }}</p>
    <div class="row">
        <div class="page-header col-sm-12">
            <h2>@if(isset($category)) {{$category->title}} @elseif(isset($type)) {{$params['type'][$type]}} @else Каталог @endif</h2>
        </div>
    </div>
    @foreach($objects as $object)
        @if ( isset($simplePagination) && $simplePagination && isset($k) && $k == $simplePagination)
            @break;
        @endif
    <!-- row -->
    <div class="row citem border-bottom" style="padding-bottom: 35px">
        <div class="col-sm-4">
            <a href="/catalog/{{ $object->url }}">
            @if( is_object($object->cover) && $object->cover->image_file_name !== NULL )
                <img src="{{ $object->cover->image->url('original') }}" alt="">
                @if ( $object->old_cost > $object->cost )
                    <div class="sticker sticker-sale">sale</div>
                @endif
                @if ( $object->bestseller )
                    <div class="sticker sticker-top">хит</div>
                @endif
                @if ( $object->new )
                    <div class="sticker sticker-new">new</div>
                @endif
            </a>
            @else
                <img src="http://placehold.it/240x250" alt="">
                @if ( $object->old_cost > $object->cost )
                    <div class="sticker sticker-sale">sale</div>
                @endif
                @if ( $object->bestseller )
                    <div class="sticker sticker-top">хит</div>
                @endif
                @if ( $object->new )
                    <div class="sticker sticker-new">new</div>
                @endif
            @endif
        </div>
        <div class="col-sm-8 cdescription">
            <div class="row">
                <div class="col-sm-8">
                    <h3 style="margin-bottom: 0"><a href="{{URL::route('catalog.url',['url' => $object->url])}}" class="black">{{ $object->title }}</a></h3>
                    <p class="color-ccc">{{ $object->rubric->title }}</p>
                </div>
                <div class="col-sm-4 text-right">
                    <div class="cost">
                        @if ( $object->old_cost > $object->cost )
                            <del style="font-size: 14px">{{ $object -> old_cost }} руб.</del>
                            <span class="new">{{ $object -> cost }} руб.</span>
                        @else
                            <div class="new">{{ $object -> cost }} руб.</div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="goods-description" style="margin-bottom: 15px">{{ $object -> short_text}}</div>
            <div class="basket-action">
                <a href="" onclick="DelProductFromCart( {{ $object->id }} );return false;" class="btn mt btn-primary stroke add-cart item-removebutton-{{ $object->id }}" @if (!$object->in_basket) style="display:none;" @endif>
                    Убрать
                </a>
                <a href="" onclick="AddToBasket( {{ $object->id }}, $('#to_basket_count{{$object->id}}').val() );return false;" class="btn btn-primary stroke add-cart item-button-{{ $object->id }}" @if ($object->in_basket) style="display:none;" @endif>
                    В корзину
                </a>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
    <!-- /.row -->
    @endforeach

    @if ( count($simplePagination)  )
    <div class="row" style="margin-bottom: 50px">
        <div class="col-md-7 col-sm-8">
            <ul class="pagination">
                {{ $objects->appends( Input::query () )->links('frontend.pagination') }}
            </ul>
            <script>
                $(document).ready(function() {
                    $('.pagination a').first().html('<i class="custom-icon custom-icon-page-prev"></i>');
                    $('.pagination a').last().html('<i class="custom-icon custom-icon-page-next"></i>');
                    $('.pagination a.active').click(function(event) {
                        event.preventDefault();
                    });
                });
            </script>
        </div>
        <div class="clearfix"></div>
    </div>
    @endif
</div>