<i class="fa fa-plus"></i>
{{$activity->created_at->formatLocalized('%d.%m.%Y в %H:%M:%S') }}
 создан тэг
{{ link_to_route('admin.tags.edit', $activity->observable->title, ['id' => $activity->observable->id]) }}