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
			@if ( isset ( $navigation ) && count ( $navigation ) )
			<section class="breadcrumbs">
				<div class="container">
					<ul class="horizontal_list clearfix bc_list f_size_medium">
						<li><a href="/" class="default_t_color">Главная</a></li><i class="fa fa-angle-right d_inline_middle m_left_10"></i>
						<li class=""><a href="/catalog" class="default_t_color">Каталог<i class="fa fa-angle-right d_inline_middle m_left_10"></i></a></li>
						@foreach ( $navigation as $k => $nav_item )
						<li class="">
							@if ( $k != count ( $navigation ) - 1 )
							<a href="{{ URL::route ( 'catalog.url', $nav_item['url'] ) }}" class="default_t_color">							
							@endif
							{{ $nav_item['title'] }}
							@if ( $k != count ( $navigation ) - 1 )
							<i class="fa fa-angle-right d_inline_middle m_left_10"></i></a>
							@endif
						</li>
						@endforeach						
					</ul>
				</div>
			</section>
			@endif
			
			<!--content-->
			<div class="page_content_offset">
				<div class="container">
					<div class="row clearfix">
						<!--left content column-->
						<section class="col-lg-9 col-md-9 col-sm-9">
							<h2 class="tt_uppercase color_dark m_bottom_25">{{ $page->title }}</h2>
							<div class="clearfix m_bottom_40">
									<!--
									<div class="photoframe f_left shadow wrapper m_right_30 m_sm_bottom_5 m_sm_right_20 m_xs_bottom_15 f_xs_none d_xs_inline_b">
										@if ( is_object ( $page->cover ) )
										<img class="tr_all_long_hover" src="{{ $page->cover->image->url('thumb') }}" alt="">
										@endif
									</div>
									-->
							</div>
							@if ( !empty ( $search_query ) )
							<div style="position:relative;top:-20px;">
								Запрос: <b>{{ $search_query }}</b>
							</div>
							@endif
							<hr class="m_bottom_15">
							<section class="products_container category_grid clearfix m_bottom_15 isotope" style="position: relative; overflow: hidden; height: 1437px;">
								<!--product item-->
								@foreach ($items as $k => $item)
								@if ( isset ( $simplePagination ) && $simplePagination && $k == $simplePagination )
									@break;
								@endif
									<div class="product_item hit w_xs_full isotope-item" style="position: absolute; left: 0px; top: 0px; transform: translate3d(0px, 0px, 0px);">
										<figure class="r_corners photoframe type_2 t_align_c tr_all_hover shadow relative">
											<!--sale product-->
											@if ($item->discount)
											<span class="hot_stripe type_2"><img src="/images/sale_product_type_2.png" alt=""></span>
											@endif

											@if ($item->bestseller)
											<!--hot product-->
											<span class="hot_stripe"><img src="/images/hot_product.png" alt=""></span>
											@endif 

											<!--product preview-->
											<a href="{{ URL::route('catalog.url', $item->url ) }}" class="d_block relative wrapper pp_wrap m_bottom_15" style="z-index:0;">

											@if ( is_object ( $item->cover ) && $item->cover->image->url('medium') !== '/images/medium/missing.png' )
													<img src="{{ $item->cover->image->url('medium') }}" class="tr_all_hover" alt="">
											@else
												<img src="/images/no_image.jpg" class="tr_all_hover" alt="{{ $item->title }}">
											@endif 
											</a>
											<!--description and price of product-->
											<figcaption>
												<h5 class="m_bottom_10"><a href="{{ URL::route('catalog.url', $item->url ) }}" class="color_dark">{{ str_limit($item->title, 50) }}</a></h5>
													@if ($item->cost !=='')
														<p class="scheme_color f_left f_size_large m_bottom_15">
															@if ($item->discount)
															<s>{{ output_numbers ( $item->cost ) }} </s>
																{{ output_numbers ( $item->cost - ( ($item->discount/100)*$item->cost )  ) }}
															@else 
															<div style="width:100%;text-align:center;" class="scheme_color f_left f_size_large m_bottom_15">
																{{ output_numbers ( $item->cost ) }} 
															</div>
															@endif
														</p>
													@else 
														<p class="scheme_color f_left f_size_large m_bottom_15">цена не указана</p><br>
													@endif
													<div class="clearfix">
													</div>
												@if ( $item->in_basket )
												<button class="button_type_4 bg_scheme_color r_corners tr_all_hover color_light mw_0 m_bottom_15 in_basket" onclick="document.location.href='/cart#order'" id="product_to_order{{ $item->id }}">Оформить заказ</button>
												@else
												<button class="button_type_4 bg_scheme_color r_corners tr_all_hover color_light mw_0 m_bottom_15 in_basket" onclick="document.location.href='/cart#order'" style="display:none;" id="product_to_order{{ $item->id }}">Оформить заказ</button>
												<button class="button_type_4 bg_scheme_color r_corners tr_all_hover color_light mw_0 m_bottom_15" onclick="AddToBasket( {{ $item->id }} )" id="product_to_basket{{ $item->id }}">Добавить в корзину</button>
												@endif
												<div class="clearfix m_bottom_5">
												</div>
											</figcaption>
										</figure>
									</div>
								@endforeach
							</section>

							<div class="row clearfix m_xs_bottom_30">
								<div class="col-lg-7 col-md-7 col-sm-7 col-xs-5">
								</div>
								<div class="col-lg-5 col-md-5 col-sm-5 col-xs-7 t_align_r">
									<!--pagination-->
									@if ( isset ( $simplePagination ) && $simplePagination && ( count($items)>$simplePagination ) )
									
									<a role="button" href="#" class="pgn f_size_large button_type_10 color_dark d_inline_middle bg_cs_hover bg_light_color_1 t_align_c tr_delay_hover r_corners box_s_none"><i class="fa fa-angle-left"></i></a>
									@endif
									<ul class="horizontal_list clearfix d_inline_middle f_size_medium m_left_10">
										<script>
											$(document).ready(function() {
												//Pagination
												lastpage = {{ $simplePagination }}-1;
												next = $('.m_right_10 a').last().attr('href');
												prev = $('.m_right_10 a').first().attr('href');
												$('li.m_right_10').first().remove();
												$('li.m_right_10').last().remove();
												$('.pgn').first().attr('href', prev)
												$('.pgn').last().attr('href', next);
												string = $('.m_right_10 a.scheme_color').last().text();
												current = parseInt(string); 
												if (current === lastpage) {
													$('.pgn').last().remove();
												}

												firstpageactive = $('.m_right_10 a.scheme_color').text();
												if (  firstpageactive == '1') {
													$('.pgn').first().remove();
												}
											});
										</script>										
										{{ $items->appends( Input::query () )->links('frontend.pagination') }}										
									</ul>
									@if ( isset ( $simplePagination ) && $simplePagination && ( count($items)>$simplePagination ) )
									<a role="button" href="#" class="pgn f_size_large button_type_10 color_dark d_inline_middle bg_cs_hover bg_light_color_1 t_align_c tr_delay_hover r_corners box_s_none"><i class="fa fa-angle-right"></i></a>
									@endif
								</div>
							</div>

							<div class="row clearfix m_xs_bottom_30">
								<div class="col-lg-7 col-md-7 col-sm-7 col-xs-5">
									<p class="m_bottom_10">{{ $page->text }}</p>
								</div>
							</div>

						</section>
						<!--right column-->
						<aside class="col-lg-3 col-md-3 col-sm-3">
							<!--widgets-->
							@include('frontend.blocks.categories')
							<figure class="widget shadow r_corners wrapper m_bottom_30">
								<figcaption>
									<h3 class="color_light">Фильтр</h3>
								</figcaption>
								<div class="widget_content">
									<!--filter form-->
									{{ Form::open ( ['url' => explode ( '?', Request::server ( 'REQUEST_URI' ) )[0], 'method' => 'get'] ) }}
										@if ( !empty ( $search_query ) )
											<input type="hidden" name="search_query" value="{{ $search_query }}"/>
										@endif
										<!--price-->
										<fieldset class="m_bottom_20">
											<legend class="default_t_color f_size_large m_bottom_15 clearfix full_width relative">
												<b class="f_left">Цена</b>
												<button type="button" class="f_size_medium f_right color_dark bg_tr tr_all_hover close_fieldset"><i class="fa fa-times lh_inherit"></i></button>
											</legend>
											<div id="price" class="m_bottom_10"></div>
											<div class="clearfix range_values">
												<input class="f_left first_limit" readonly name="mincost" type="text" value="@if($min_cost){{ $min_cost }}@else{{ $initialMinCost }}@endif">
												<input class="f_right last_limit t_align_r" readonly name="maxcost" type="text" value="@if($max_cost){{ $max_cost }}@else{{ $initialMaxCost }}@endif">
											</div>
										</fieldset>
										<button type="submit" class="color_dark bg_tr text_cs_hover tr_all_hover"><i class="fa fa-refresh lh_inherit m_right_10"></i>Применить фильтр</button>
									{{ Form::close () }}
								</div>
							</figure>
<script>
	$(document).ready(function() {
	(function(){
		var slider;
		if($('#price').length){
			slider = $('#price').slider({ 
			 	orientation: "horizontal",
				range: true,
				values: [@if($min_cost){{ $min_cost }}@else{{ $initialMinCost }}@endif, @if($max_cost){{ $max_cost }}@else{{ $initialMaxCost }}@endif],
				min: {{ $initialMinCost }},
				max: {{ $initialMaxCost }},
				slide : function(event ,ui){
					$(this).next().find('.first_limit').val(ui.values[0]);
					$(this).next().find('.last_limit').val(ui.values[1]);
				}
			});
		}

		var color = $('.select_color').on('click',function(){
			$(this).addClass('active').parent().siblings().children('button').removeClass('active');
		});

		$('.close_fieldset').on('click',function(){
			$(this).closest('fieldset').animate({
				'opacity':'0'
			},function(){
				$(this).slideUp();
			});
		});

		$('button[type="reset"]:not(#styleswitcher button[type="reset"])').on('click',function(){
			color.eq(0).addClass('active').parent().siblings().children('button').removeClass('active');
			slider.slider( "option", "values", [ 0, 237 ] );
		});

		$('.categories_list').on('click','a',function(e){
			if($(this).parent().children('ul').length){
				$(this).parent().toggleClass('active').end().next().slideToggle();
				e.preventDefault();
			}
		});

		$('.categories_list > li > a').on('click',function(e){
			if($(this).parent().children('ul').length){
				$(this).toggleClass('scheme_color').toggleClass('color_dark');
				e.preventDefault();
			}
		});

	})();		
	});
</script>
							@include ('frontend.blocks.asidebanner')

							@include ('frontend.blocks.bestsellers')

						</aside>
					</div>
				</div>
			</div>
			@include ('frontend.blocks.footer')
		</div>
		@include ('frontend.blocks.modals')
@endsection