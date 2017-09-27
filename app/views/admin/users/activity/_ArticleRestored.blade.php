<i class="fa fa-arrow-up"></i>
{{$activity->created_at->formatLocalized('%d.%m.%Y в %H:%M:%S') }}
 восстановлена статья 
{{ link_to_route('admin.articles.edit', $activity->observable->title, ['id' => $activity->observable->id]) }}