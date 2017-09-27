@extends ( 'frontend.layouts.master' )

@section('content')

    @if (isset($slides) and count($slides) )
        @include('frontend.layouts._slides_inner_page',['slides' => $slides,'page' => $page])
    @endif

<div class="content">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 no-padding">
                <!-- row -->

                <div id="ya-site-results" onclick="return {'tld': 'ru','language': 'ru','encoding': '','htmlcss': '1.x','updatehash': true}" style="z-index: 0"></div>

                <script type="text/javascript">(function(w,d,c){var s=d.createElement('script'),h=d.getElementsByTagName('script')[0];s.type='text/javascript';s.async=true;s.charset='utf-8';s.src=(d.location.protocol==='https:'?'https:':'http:')+'//site.yandex.net/v2.0/js/all.js';h.parentNode.insertBefore(s,h);(w[c]||(w[c]=[])).push(function(){Ya.Site.Results.init();})})(window,document,'yandex_site_callbacks');</script>


            </div>
        </div>
    </div>
</div>



@endsection
