<i class="fa fa-arrow-up"></i>
{{$activity->created_at->formatLocalized('%d.%m.%Y в %H:%M:%S') }}
 восстановлена страница 
{{ link_to_route('admin.pages.edit', $activity->observable->title, ['id' => $activity->observable->id]) }}