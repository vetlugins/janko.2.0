<ul class="sidebar-menu">
    <li @if($params['route'] == 'dashboard') class="active" @endif>
        <a href="{{ URL::route('admin') }}">
            <i class="fa fa-home"></i> <span>Панель управления</span>
        </a>
    </li>
    <li class="title">Контент</li>

    @include('admin.layout._nav_modules', ['items' => $modContent])

    <li class="title">Каталог товаров</li>

    @include('admin.layout._nav_modules', ['items' => $modCatalog])

    <li class="title">Управление</li>

    @include('admin.layout._nav_modules', ['items' => $modManage])

</ul>