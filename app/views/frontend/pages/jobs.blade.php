@extends ( 'frontend.layouts.master' )

@section('content')
    <div class="header-pages">
        <img src="/img/header-page.jpg">
        <div class="content-wrp">
            <div class="header-pages-title">{{ $page->title }}</div>
        </div>
    </div>
    <div class="content-wrp" style="margin-top:40px;margin-bottom:90px;">
        <div class="l-block">
            @foreach ($jobs as $item)
                <div class="vacancy">
                    <a href="" class="vacancy-link transition" onclick="return false">
                        <span>
                            {{ $item->title }}
                        </span>
                    </a>
                    <div class="vacancy-info transition">
                        <div>
                            {{ $item->text }}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="r-block">
            <div class="sidebar-title">
                {{ $local['vacancy'] }}
            </div>
            <form class="sidebar-form">
                <label><span>{{{ $local['name'] }}}</span><input type="text"></label>
                <label><span>{{ $local['email'] }}</span><input type="text"></label>
                <label><span>{{ $local['resume'] }}</span><textarea style="resize:none;"></textarea></label>
                <button type="submit" class="button transition" style="margin-top:40px;">
                    {{ $local['vacancy'] }}
                </button>
            </form>
        </div>
        <div style="clear:both;"></div>
    </div>
@endsection