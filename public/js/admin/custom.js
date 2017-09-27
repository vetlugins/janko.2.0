(function($) {
	"use strict";
    //Enable sidebar toggle
	$('.sidebar-toggle').click( function() {
		$("body").toggleClass("sidebar-sm");
		$(".leftside, header .logo").toggleClass("display-inline");
		return false;
    });
	
	//Chat Open
	$('.online-users .item').click( function() {
		$(".online-list").addClass("display-none");
		$(".chat").addClass("display-show");
		return false;
	});
	
	//Chat Close
	$('.online-users .close-chat').click( function() {
		$(".chat").removeClass("display-show");
		$(".online-list").removeClass("display-none");
		return false;
	});
	
	//Dropdown Animated
	$('.dropdown').on('show.bs.dropdown', function () {
		$(this).find('.dropdown-menu').addClass('animated flipInY');
	});
	$('.dropdown').on('hide.bs.dropdown', function () {
		$(this).find('.dropdown-menu').removeClass('animated flipInY');
	});	
	
    //Tooltip
    $("[data-toggle='tooltip']").tooltip();
	
	//Dropdown-menu Scroll
	$(".navbar .dropdown-menu ul").slimscroll({
        alwaysVisible: false,
        size: "3px",
        height: "210px"
    }).css("width", "100%");
	
    //Collapse Box
	$('.collapse-box').click(function(b){
		b.preventDefault();
		var $box = $(this).parent().parent().next('.box-body');
		if($box.is(':visible')) 
		{
		  $(this).children('i').removeClass('fa-chevron-up');
		  $(this).children('i').addClass('fa-chevron-down');
		}
		else 
		{
		  $(this).children('i').removeClass('fa-chevron-down');
		  $(this).children('i').addClass('fa-chevron-up');
		}            
		$box.slideToggle("slow");
	}); 
	
	//Remove Box
    $(".remove-box").click(function() {
        var box = $(this).parents(".box").first();
        box.slideUp();
    });

	$(".sidebar").slimscroll({
		color: "rgba(0,0,0,0.5)",
		height: ($(window).height() - $("header").height() - $(".sidebar-widget .footer").innerHeight()) + "px",
	});

	//Sidebar
    $.fn.sub = function() {
        return this.each(function() {  var btn = $(this).children("a").first(); var menu = $(this).children(".sub-menu").first();  var active = $(this).hasClass('active');
		if (active) {
            menu.show();
            btn.children(".fa-angle-right").first().removeClass("fa-angle-right").addClass("fa-angle-down");
        }
        btn.click(function(e) { e.preventDefault();
			if (active) {
				menu.slideUp(200);
				active = false;
				btn.children(".fa-angle-down").first().removeClass("fa-angle-down").addClass("fa-angle-right");
				btn.parent("li").removeClass("active");
			} else {
				menu.slideDown(200);
				active = true;
				btn.children(".fa-angle-right").first().removeClass("fa-angle-right").addClass("fa-angle-down");
				btn.parent("li").addClass("active");
			}
        	});
    	});
	};

	//Sidebar Nav
	$(".sidebar .sub-nav").sub();

	// Hide Show
	$('.hideShow').click(function(){

		var id = $(this).data('id');
		var action = $(this).data('action');
		var selector = $(this);

		$.ajax({
			 type: "GET",
			 url: action,
			 data: 'id='+id,
			 success: function(data){

			 var obj = $.parseJSON(data);

				 if (obj == false) {
					selector.removeClass("btn-success").addClass("btn-warning");
					selector.find('i').removeClass("fa-eye").addClass("fa-eye-slash");
				 }else{
					selector.removeClass("btn-warning").addClass("btn-success");
					selector.find('i').removeClass("fa-eye-slash").addClass("fa-eye");
				 }
			 }
		 });

		return false;
	});

	//Edit photo
	$('.edit-photo-name').hide();

	$('.edit-photo-title').click(function(){

		var selector = $(this);
		var parent = selector.parent('div').parent('div').parent('div');

		parent.find('.edit-photo-block').fadeOut();
		parent.find('.edit-photo-name').fadeIn();

	});

	$('.close_edit_title').click(function(){

		var selector = $(this);
		var parent = selector.parent('div').parent('div').parent('div').parent('div');

		parent.find('.edit-photo-block').fadeIn();
		parent.find('.edit-photo-name').fadeOut();

	});

	$('.edit_title').click(function(){

		var selector = $(this);
		var action = $(this).data('action');
		var id = $(this).data('id');
		var parent = selector.parent('div').parent('div').parent('div').parent('div');
		var title = parent.find('input').val();

		$.ajax({
			type: "GET",
			url: action,
			data: 'title='+title+'&id='+id,
			success: function(data){

				parent.find('.title_text').html(data.title);

				parent.find('.edit-photo-block').fadeIn();
				parent.find('.edit-photo-name').fadeOut();
			}
		});

		return false;

	});

	// Sortable
	$(function() {
		$(".list-drag-n-drop, .list-drag-n-drop .parent").sortable({tolerance: "pointer", opacity: 0.6, cursor: 'move', update: function() {

			var items = $(this).sortable("serialize");
			var action = $(this).data("action");

			$.post(action, items, function(theResponse){

			});
		}
		});
	});

})(jQuery);

