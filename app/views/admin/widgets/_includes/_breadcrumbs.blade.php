<li>{{ link_to_route( 'admin', trans ( 'admin_titles.main_title' ) ) }}</li>
<li>{{ link_to_route ('admin.'.$params['route'].'.index', 'Виджеты') }}</li>

<li class="active">{{trans ( 'admin_titles.editing' ) }} "{{ $item->title }}" </li>