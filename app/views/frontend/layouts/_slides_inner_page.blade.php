<!-- HOME -->
@foreach($slides as $k => $item)
<div class="overlay home medium-size">
    <div class="bg bg-text" style="background-image: url('{{ $item->cover->image->url('medium') }}');"  ></div>
    <div class="container vmiddle">
        <div class="row  description-slider-not-main"></div>
    </div>
</div>
@break
@endforeach
<!-- /.home -->
