<i class="fa fa-arrow-up"></i>
{{$activity->created_at->formatLocalized('%d.%m.%Y в %H:%M:%S') }}
 восстановлен тэг
{{ link_to_route('admin.tags.edit', $activity->observable->title, ['id' => $activity->observable->id]) }}