<ul class="itemsList list-drag-n-drop no-margin no-padding">
    @foreach ($items->afiles as $item)
        @include('admin.files._list')
    @endforeach
</ul>