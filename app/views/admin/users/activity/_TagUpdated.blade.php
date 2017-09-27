<i class="fa fa-edit"></i>
{{$activity->created_at->formatLocalized('%d.%m.%Y в %H:%M:%S') }}
 отредактирован тэг
{{ link_to_route('admin.tags.edit', $activity->observable->title, ['id' => $activity->observable->id]) }}