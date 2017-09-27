@if(isset($item))

    @if(isset($item['current']) and $item['current'] == $item['id'])
        @define $current = 'selected'
    @else
        @define $current = ''
    @endif

    <option value="{{ $item['id'] }}" {{ $current }}>{{ $item['dash'] }} {{ $item['title'] }}</option>

    @if(isset($item['get_children']) and isset($item['parents']) and  count($item['parents']) > 0)
        {{ $item['get_children'] }}
    @endif

@endif