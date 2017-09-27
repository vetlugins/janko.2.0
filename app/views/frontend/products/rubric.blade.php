@extends('frontend.layouts.inner')
@section ('content')
		<!--wide layout-->
		<div class="wide_layout relative">
			<!--[if (lt IE 9) | IE 9]>
				<div style="background:#fff;padding:8px 0 10px;">
				<div class="container" style="width:1170px;"><div class="row wrapper"><div class="clearfix" style="padding:9px 0 0;float:left;width:83%;"><i class="fa fa-exclamation-triangle scheme_color f_left m_right_10" style="font-size:25px;color:#e74c3c;"></i><b style="color:#e74c3c;">Attention! This page may not display correctly.</b> <b>You are using an outdated version of Internet Explorer. For a faster, safer browsing experience.</b></div><div class="t_align_r" style="float:left;width:16%;"><a href="http://windows.microsoft.com/en-US/internet-explorer/products/ie/home?ocid=ie6_countdown_bannercode" class="button_type_4 r_corners bg_scheme_color color_light d_inline_b t_align_c" target="_blank" style="margin-bottom:2px;">Update Now!</a></div></div></div></div>
			<![endif]-->

			@include ('frontend.blocks.header')
			
			<!--breadcrumbs-->
			<section class="breadcrumbs">
				<div class="container">
					<ul class="horizontal_list clearfix bc_list f_size_medium">
						<li><a href="/" class="default_t_color">Главная</a></li><i class="fa fa-angle-right d_inline_middle m_left_10"></i>
						<li class="m_right_10"><a href="/catalog" class="default_t_color">Каталог<i class="fa fa-angle-right d_inline_middle m_left_10"></i></a></li>
						<li style="position:relative;left:-10px;">{{ $page->title }}</li>
					</ul>
				</div>
			</section>

			
			<!--content-->
			<div class="page_content_offset">
				<div class="container">
					<div class="row clearfix">
						<!--left content column-->						
							<section class="products_container category_grid clearfix m_bottom_15 isotope col-lg-9 col-md-9 col-sm-9" style="position: relative; overflow: hidden; height: 1437px;">
								@foreach ($page->rubrics as $subrubric)
									<div class="product_item hit w_xs_full isotope-item" style="position: absolute; left: 0px; top: 0px; transform: translate3d(0px, 0px, 0px);">
										<figure class="r_corners photoframe type_2 t_align_c tr_all_hover shadow relative">
											<a href="{{ URL::route('catalog.url', $subrubric->url ) }}" class="d_block relative wrapper pp_wrap m_bottom_15">
											@if ( is_object ( $subrubric->cover ) )
												<img class="tr_all_long_hover" src="{{ $subrubric->cover->image->url('thumb') }}" alt="{{ $subrubric->title }}">
											@endif 
											</a>
											<figcaption>
												<h5 class="m_bottom_10"><a href="{{ URL::route('catalog.url', $subrubric->url ) }}" class="color_dark">{{ $subrubric->title }}</a></h5>
												<div class="clearfix m_bottom_5">
												</div>
											</figcaption>
										</figure>
									</div>
								@endforeach
							</section>
		

						<!--right column-->
						<aside class="col-lg-3 col-md-3 col-sm-3">
							@include ('frontend.blocks.categories')

							@include ('frontend.blocks.bestsellers')
						
							@include ('frontend.blocks.asidebanner')

		
						</aside>
					</div>
				</div>
			</div>
			@include ('frontend.blocks.footer')
		</div>
		@include ('frontend.blocks.modals')
@endsection