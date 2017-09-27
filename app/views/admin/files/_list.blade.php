<li>
	<div class="item">

		<div class="pull-left" style="padding: 15px 0 0 10px">
			<a href="{{ $item->get_link() }}" target="_blank"><strong>{{$item->title}}</strong></a>
		</div>

		<div class="pull-right padding-sm">
			<a class="btn btn-success" href="{{ $item->get_link() }}" target="_blank" data-toggle="tooltip" title="Скачать файл"><i class="fa fa-download"></i></a>
			<a class="btn btn-info" title="{{ $item->ext }}" data-toggle="tooltip"><i class="fa fa-{{ fa_ext($item->ext) }}" style="cursor: default"></i></a>
			<a
					title="{{ trans('admin_titles.item_delete') }}"
					class="btn btn-danger icon-cancel"
					data-toggle="tooltip"
					href="{{ URL::route( 'admin.'.$params['route'].'.destroy', $item->id) }}"
					data-method="delete" data-confirm="{{ trans('admin_messages.'.$params['route'].'.to_delete') }}"
					>
				{{ HTML::icon('times') }}
			</a>

		</div>

		<div class="clearfix"></div>

	</div>
</li>
