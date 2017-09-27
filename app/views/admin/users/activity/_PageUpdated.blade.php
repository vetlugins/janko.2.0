<i class="fa fa-edit"></i>
{{$activity->created_at->formatLocalized('%d.%m.%Y в %H:%M:%S') }}
 отредактирована страница 
{{ link_to_route('admin.pages.edit', $activity->observable->title, ['id' => $activity->observable->id]) }}