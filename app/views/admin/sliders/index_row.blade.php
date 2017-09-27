{{ link_to_route( $cur_lang_route.'admin.'.$params['route'].'.edit', $item->title, ['id' => $item->id]) }}
<div class="edit-block">
	<i class="fa fa-file-text-o icon-eye vis {{ $item->visible ? 'vis1' : 'vis0' }}" title="{{ trans('admin_titles.item_visibility') }}" id="icon_vis{{ $item->id }}" rel="{{ $item->id }}" rev="{{ URL::route( $cur_lang_route.'admin.'.$params['route'].'.visibility') }}"></i>
	<a title="{{ trans('admin_titles.item_edit') }}" class="icon-edit" href="{{ URL::route( $cur_lang_route.'admin.'.$params['route'].'.edit', $item->id) }}">{{ HTML::icon('edit') }}</a>
	<a title="{{ trans('admin_titles.item_delete') }}" class="icon-cancel" href="{{ URL::route( $cur_lang_route.'admin.'.$params['route'].'.destroy', $item->id) }}" data-method="delete" data-confirm="{{ trans('admin_messages.'.$params['route'].'.to_delete') }}">{{ HTML::icon('times') }}</a>
</div>