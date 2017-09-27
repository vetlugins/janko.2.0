<i class="fa fa-plus"></i>
{{$activity->created_at->formatLocalized('%d.%m.%Y в %H:%M:%S') }}
 создана статья 
{{ link_to_route('admin.article.edit', $activity->observable->title, ['id' => $activity->observable->id]) }}