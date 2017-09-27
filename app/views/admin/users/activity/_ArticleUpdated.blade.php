<i class="fa fa-edit"></i>
{{$activity->created_at->formatLocalized('%d.%m.%Y в %H:%M:%S') }}
 отредактирована статья 
{{ link_to_route('admin.articles.edit', $activity->observable->title, ['id' => $activity->observable->id]) }}