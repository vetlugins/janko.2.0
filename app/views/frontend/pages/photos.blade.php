@if ( count ( $page->photos ) )
<div class="img-wrp">
    @foreach ( $page->photos as $photo )
    <a href="{{ $photo->image->url ( 'big' ) }}" data-lightbox="image-1"><img src="{{ $photo->image->url ( 'thumb' ) }}"></a>
    @endforeach
</div>
@endif