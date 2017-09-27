<i class="fa fa-trash-o"></i>
{{$activity->created_at->formatLocalized('%d.%m.%Y в %H:%M:%S') }}
 удалена страница 
{{ $activity->observable->title }}
@if ($activity->observable->trashed())
	&nbsp;{{ link_to_route('admin.pages.restore', 'Восстановить', ['id' => $activity->observable->id], ['data-method' => 'POST']) }}
@endif