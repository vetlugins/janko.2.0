<div class="container">
    <div class="col-md-4 col-sm-3 logo not-sticky">
        <a href="index.html">{{ param('site_name') }}</a>
    </div>
    <div class="col-md-1 col-sm-1 iconmenu pull-right">
        <a href="" class="a-search"><i class="custom-icon custom-icon-ico-search"></i></a>
        <a href="" class="a-menu"><i class="custom-icon custom-icon-ico-menu"></i></a>
    </div>
    <div class="col-md-4 contact-info">
        <span class="phone">{{ param('contact_phone_main') }}</span>
        <a class="a-email" href="mailto:{{ param('contact_email_main') }}">{{ param('contact_email_main') }}</a>
    </div>
    <div class="col-md-7 col-sm-10 mainmenu">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbar-collapse">
            <nav>
                <ul class="nav navbar-nav">
                    @foreach ( $top_menu as $menu )
                        <li class="dropdown">
                            <a class="dropdown-toggle" href="{{ $menu->getUrl () }}">{{{ $menu->title }}}</a>
                            @if ( count ( $menu->sub_menu ) )
                                <ul class="dropdown-menu">
                                    @foreach ( $menu->sub_menu as $sub_menu_item )
                                        <li>
                                            <a href="{{ $sub_menu_item->getUrl () }}">{{ $sub_menu_item->title }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </nav>
        </div>
    </div>
</div>
<div class="search">
    <div class="container">
        <form action="/">
            <div class="col-sm-6 col-sm-offset-3 col-xs-10">
                <input type="text" autofocus placeholder="Что ищем?">
            </div>
            <div class="col-md-1 col-xs-2">
                <a href="" class="sclose"><i class="custom-icon custom-icon-lightclose"></i></a>
            </div>
        </form>
    </div>
</div>