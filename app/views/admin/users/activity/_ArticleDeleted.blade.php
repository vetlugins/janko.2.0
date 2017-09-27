<i class="fa fa-trash-o"></i>
{{$activity->created_at->formatLocalized('%d.%m.%Y в %H:%M:%S') }}
 удалена статья 
{{ $activity->observable->title }}
@if ($activity->observable->trashed())
	&nbsp;{{ link_to_route('admin.articles.restore', 'Восстановить', ['id' => $activity->observable->id], ['data-method' => 'POST']) }}
@endif