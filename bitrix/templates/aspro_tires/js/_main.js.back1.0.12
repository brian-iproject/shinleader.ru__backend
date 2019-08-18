var addEventTimer;

$.expr[':'].findContent = function(obj, index, meta) 
{
	var matchParams = meta[3].split(',');
	regexFlags = 'ig';
	regex = new RegExp('^' + $.trim(matchParams) + '$', regexFlags);
	return regex.test($(obj).text());
};

var funcDefined = function(func){ 
	try {
		if (typeof func == 'function') {
			return true;
		} else {
			return typeof window[func] === "function";	
		}
	} catch (e) {
		return false;
	} 
}

if(!funcDefined('markProductRemoveBasket')){ 
	var markProductRemoveBasket = function markProductRemoveBasket(id){
		$('.to-cart[data-item='+id+']').show();
		$('.to-cart[data-item='+id+']').parent().find('.in-cart').hide();
	}
}

if(!funcDefined('markProductAddBasket')){ 
	var markProductAddBasket = function markProductAddBasket(id){		
		$('.to-cart[data-item='+id+']').hide();
		$('.to-cart[data-item='+id+']').parent().find('.in-cart').show();;
	}
}

if(!funcDefined("InitOrderCustom")){
	InitOrderCustom = function () {
		$('.ps_logo img').wrap('<div class="image"></div>');
		
		$('#bx-soa-order .radio-inline').each(function() {
			if ($(this).find('input').attr('checked') == 'checked') {
				$(this).addClass('checked');
			}
		});

		$('#bx-soa-order .checkbox input[type=checkbox]').each(function() {
			if ($(this).attr('checked') == 'checked')
				$(this).parent().addClass('checked');
		});

		$('#bx-soa-order .bx-authform-starrequired').each(function() {
			var html = $(this).html();
			$(this).closest('label').append('<span class="bx-authform-starrequired"> '+ html + '</span>');
			$(this).detach();
		});
		$('.bx_ordercart_coupon').each(function() {
			if ($(this).find('.bad').length)
				$(this).addClass('bad');
			else if ($(this).find('.good').length)
				$(this).addClass('good');
		});
	}
}

if(!funcDefined('orderActions')){
	orderActions = function(){
		if(arTiresOptions["PAGES"]["ORDER_PAGE"]){
			if($('.bx-soa-cart-total').length){
				if(!$('.change_basket').length)
					$('.bx-soa-cart-total').prepend('<div class="change_basket">'+BX.message("BASKET_CHANGE_TITLE")+'<a href="'+arTiresOptions["SITE_DIR"]+'basket/" class="change_link">'+BX.message("BASKET_CHANGE_LINK")+'</a></div>');
				if(typeof (BX.Sale.OrderAjaxComponent) == "object"){
					if(BX.Sale.OrderAjaxComponent.hasOwnProperty("params")){
						$('.bx-soa-cart-total .change_link').attr('href', BX.Sale.OrderAjaxComponent.params.PATH_TO_BASKET);
					}
				}
			}
		}
	}
}

if(!funcDefined('reloadPopupBasket')){ 
	var reloadPopupBasket = function reloadPopupBasket(popupWindow, reload, delay){
		if(window.matchMedia('(min-width: 520px)').matches){
			if(arTiresOptions['THEME']['SHOW_BASKET_ONADDTOCART'] !== 'N'){
				if(typeof delay === "undefined"){
					delay=500;
				}
				var classPopupWindow='.'+popupWindow,
					classPopupWindowFrame='.'+popupWindow+'_frame';

				if((typeof reload !=="undefined") && reload=="Y" && $(document).find(classPopupWindowFrame).length){	
					$.ajax({
						url: arTiresOptions['TIRES_SITE_DIR']+"ajax/show_basket_popup_modal.php",
						type: 'POST',
						error: function(data) { window.console&&console.log(data); },
						success: function(html){
							$(classPopupWindowFrame).html(html);
						}
					});
				}else{
					if(addEventTimer){
						clearTimeout(addEventTimer);
						addEventTimer = false;
					}			
					addEventTimer=setTimeout(function(){
						if(typeof popupWindow !== "undefined" ){
							$('body').find('.jqmOverlay').remove();
							$('body').find(classPopupWindow+'_frame').remove();
							$('body').find(classPopupWindow).remove();
							$('body').append('<div class="'+popupWindow+'_frame popup"></div>');
							$('body').append('<span class="'+popupWindow+'"></span>');
							$(classPopupWindowFrame).jqm({trigger: classPopupWindow, onLoad: function( hash ){ onLoadjqm( name , hash ); }, ajax: arTiresOptions["TIRES_SITE_DIR"]+'ajax/show_basket_popup_modal.php'});

							setTimeout(function(){
								var popupWidth = $(classPopupWindowFrame).width();
								var popupHeight = $(classPopupWindowFrame).height();
								$(classPopupWindowFrame).css({
									'margin-left': '-' + popupWidth / 2 + 'px',
									'display': 'block',
									'top': $(document).scrollTop() + (($(window).height() > popupHeight ? ($(window).height() - popupHeight) / 2 : 10))   + 'px'
								})
							}, delay);
							$(classPopupWindow).trigger('click');
							addEventTimer=false;
						}
					}, delay);
				}
			}
		}
	}
}

if(!funcDefined('actionBasket')){ 
	var actionBasket = function actionBasket(action, id, reload){
		obj={};
		if(typeof action !=="undefined"){
			obj["ACTION"]=action;
			if(typeof id !=="undefined"){
				obj["ID"]=id;
				$.ajax({
					url: arTiresOptions['TIRES_SITE_DIR']+"ajax/action_basket.php",
					data: obj,
					type: 'POST',
					dataType: 'json',
					error: function(data) { window.console&&console.log(data); },
					success: function(data){
						if((typeof reload !=="undefined") && reload=="Y"){
							reloadPopupBasket('card_popup', 'Y');						
							jsAjaxUtil.InsertDataToNode(arTiresOptions["TIRES_SITE_DIR"]+'ajax/show_basket_line.php', 'basket_line', false);
						}
					}
				});
			}
		}
	}
}


if (!funcDefined("fRand"))
{
	var fRand = function() {return Math.floor(arguments.length > 1 ? (999999 - 0 + 1) * Math.random() + 0 : (0 + 1) * Math.random());};
}

if (!funcDefined("waitForFinalEvent"))
{
	var waitForFinalEvent = (function () 
	{
	  var timers = {};
	  return function (callback, ms, uniqueId) 
	  {
		if (!uniqueId) {
		  uniqueId = fRand();
		}
		if (timers[uniqueId]) {
		  clearTimeout (timers[uniqueId]);
		}
		timers[uniqueId] = setTimeout(callback, ms);
	  };
	})();
}
	
$.fn.equalizeHeights = function() 
{
	var maxHeight = this.map(function(i, e) {return $(e).height();}).get();
	return this.height(Math.max.apply(this, maxHeight));
};

$.fn.keyupDelay = function( cb, delay ){
	if(delay == null){
		delay = 1000;
	}
	var timer = 0;
	return $(this).on('keyup',function(e){
		clearTimeout(timer);
		timer = setTimeout( cb , delay );
	});
}

if (!funcDefined("phoneCall"))
{
	var phoneCall = function(phoneWrapper)
	{
		var phoneNumber = ($(phoneWrapper).find(".phone-code").text().trim() + $(phoneWrapper).find(".phone").text().trim()).replace(/\s+/g,'').replace(/\-+/g,'');
		
		window.console&&console.log("phoneCall, phoneNumber="+phoneNumber);
		
		if (phoneNumber)
		{
			window.console&&console.log(phoneNumber);
			window.location.href="tel:"+phoneNumber;
			return true;
		}
		else
		{
			return false;
		}		
	}
}

if (!funcDefined("onLoadjqm"))
{
	var onLoadjqm = function (name ,hash)
	{
		hash.w.addClass('show').css({
			'margin-left': ($(window).width() > hash.w.outerWidth() ? '-' + hash.w.outerWidth() / 2 + 'px' : '-' + $(window).width() / 2 + 'px'),
			'top': $(document).scrollTop() + (($(window).height() > hash.w.outerHeight() ? ($(window).height() - hash.w.outerHeight()) / 2 : 10))   + 'px'
		});
		
		if(name=="order-popup-call")
		{

		}
		else if(name=="order-button")
		{

			$(".order-button_frame").find("div[product_name]").find("input").val(hash.t.title).attr("readonly", "readonly").css({"overflow": "hidden", "text-overflow": "ellipsis"});
		}
		else if ( name == 'one_click_buy')
		{	
			$('#one_click_buy_form_button').on("click", function() {
				if(!$(this).hasClass("clicked")){
					if($('#one_click_buy_form').valid()){
						$(this).addClass("clicked");
						$("#one_click_buy_form").submit(); //otherwise don't works
					}
				}
			});
			$('#one_click_buy_form').submit( function() 
			{
				if($('.'+name+'_frame form input.error').length || $('.'+name+'_frame form textarea.error').length) {
					return false
				}
				else{
					$.ajax({
						url: $(this).attr('action'),
						data: $(this).serialize(),
						type: 'POST',
						dataType: 'json',
						error: function(data) { alert('Error connecting server'); },
						success: function(data) 
						{
							if(data.result=='Y') { $('.one_click_buy_result').show(); $('.one_click_buy_result_success').show(); } 
							else { $('.one_click_buy_result').show(); $('.one_click_buy_result_fail').show(); $('.one_click_buy_result_text').text(data.message);}
							$('.one_click_buy_modules_button', self).removeClass('disabled');
							$('#one_click_buy_form').hide();
							$('#one_click_buy_form_result').show();
						}
					});
				}
				return false;
			});
		}
		else if ( name == 'one_click_buy_basket')
		{	
			$('#one_click_buy_form_button').on("click", function() {
				if(!$(this).hasClass("clicked")){
					if($('#one_click_buy_form').valid()){
						$(this).addClass("clicked");
						$("#one_click_buy_form").submit(); //otherwise don't works
					}
				}
			});
			$('#one_click_buy_form').live("submit", function() 
			{
				if($('.'+name+'_frame form input.error').length || $('.'+name+'_frame form textarea.error').length) {
					return false
				}
				else{
					$.ajax({
						url: $(this).attr('action'),
						data: $(this).serialize(),
						type: 'POST',
						dataType: 'json',
						error: function(data) { window.console&&console.log(data); },
						success: function(data) 
						{
							if(data.result=='Y') { $('.one_click_buy_result').show(); $('.one_click_buy_result_success').show(); } 
							else { $('.one_click_buy_result').show(); $('.one_click_buy_result_fail').show(); $('.one_click_buy_result_text').text(data.message);}
							$('.one_click_buy_modules_button', self).removeClass('disabled');
							$('#one_click_buy_form').hide();
							$('#one_click_buy_form_result').show();
							// jsAjaxUtil.InsertDataToNode(arTiresOptions["TIRES_SITE_DIR"]+'ajax/show_order.php?ORDER_ID='+data.message, 'content', true);
							jsAjaxUtil.InsertDataToNode(arTiresOptions["TIRES_SITE_DIR"]+'ajax/show_basket_line.php', 'basket_line', false);
							
							jsAjaxUtil.ShowLocalWaitWindow( 'id', 'personal_block', true );
							$.ajax( { url: $("#auth_params").attr("action"), data: $("#auth_params").serialize() }).done(function( text ) 
							{
								$('#personal_block').html(text);
								jsAjaxUtil.CloseLocalWaitWindow( 'id', 'personal_block' );
							});
							
							hash.w.addClass('show').css({'top': '160px'});
							$("html,body").scrollTop(0);
						}
					});
				}
				return false;
			});
		}
		
		$('.'+name+'_frame').show();
	}
}

if(!funcDefined('onHidejqm')){
	var onHidejqm = function(name, hash){
		if (hash.w.find('.one_click_buy_result_success').is(':visible') && name=="one_click_buy_basket") {
			window.location.href = window.location.href;
		}
		hash.w.css('opacity', 0).hide();
		hash.w.empty();
		hash.o.remove();
		hash.w.removeClass('show');
	}
}

if (!funcDefined("showOffersStores"))
{
	var showOffersStores = function (elementID)
	{	
		var formParams = $("#show_offers_stores").serialize()+"&ID="+elementID;
		name = 'offers_stores';
		$('body').find('.'+name+'_frame').remove();
		$('body').append('<div class="'+name+'_frame popup"></div>');
		$('.'+name+'_frame').jqm({trigger: '.'+name+'_frame.popup', onHide: function(hash) { onHidejqm(name,hash); }, onLoad: function( hash ){ onLoadjqm( "one_click_buy", hash ); }, ajax: $("#show_offers_stores").attr("action")+"?"+formParams});
		$('.'+name+'_frame.popup').click();	
	}
}

if (!funcDefined("oneClickBuy"))
{
	var oneClickBuy = function (elementID, iblockID)
	{	
		name = 'one_click_buy';
		elementQuantity = $(".info .to-cart").attr("data-quantity");
		$('body').find('.'+name+'_frame').remove();
		$('body').append('<div class="'+name+'_frame popup"></div>');
		$('.'+name+'_frame').jqm({trigger: '.'+name+'_frame.popup', onHide: function(hash) { onHidejqm(name,hash); }, onLoad: function( hash ){ onLoadjqm( "one_click_buy", hash ); }, ajax: arTiresOptions["TIRES_SITE_DIR"]+'ajax/one_click_buy.php?ELEMENT_ID='+elementID+'&IBLOCK_ID='+iblockID+'&ELEMENT_QUANTITY='+elementQuantity});
		$('.'+name+'_frame.popup').click();	
	}
}

if (!funcDefined("oneClickBuyBasket"))
{
	var oneClickBuyBasket = function ()
	{	
		name = 'one_click_buy_basket'
		$('body').find('.'+name+'_frame').remove();
		$('body').append('<div class="'+name+'_frame popup"></div>');
		$('.'+name+'_frame').jqm({trigger: '.'+name+'_frame.popup', onHide: function(hash) { onHidejqm(name,hash); }, onLoad: function( hash ){ onLoadjqm( "one_click_buy_basket", hash ); }, ajax: arTiresOptions["TIRES_SITE_DIR"]+'ajax/one_click_buy_basket.php'});
		$('.'+name+'_frame.popup').click();	
	}
}

if (!funcDefined("jqmEd"))
{
	var jqmEd = function ( name, form_id )
	{
		if (form_id!="auth")
		{
			form_id = parseInt(form_id);
		}
		$('body').find('.'+name+'_frame').remove();
		$('body').append('<div class="'+name+'_frame popup"></div>');
		$('.'+name+'_frame').jqm({trigger: '.'+name, onHide: function(hash) { onHidejqm(name,hash); }, onLoad: function( hash ){ onLoadjqm( name , hash ); }, ajax: arTiresOptions["TIRES_SITE_DIR"]+'ajax/form.php?form_id='+form_id});
	}
}

if (!funcDefined("carouselEqualizeheights"))
{
	var carouselEqualizeheights = function()
	{
		if( $('.corusel-list').html() != undefined )
		{
			
			var textWrapper = $(".corusel-list .item .item-title").height();
			var textContent = $(".corusel-list .item .item-title a");
			$(textContent).each(function()
			{
				if ($(this).outerHeight()>textWrapper) 
				{
					$(this).text(function (index, text) { return text.replace(/\W*\s(\S)*$/, '...'); });
				}
			});
			
			var itemCol = $('.corusel-list .item .item-title');
			for( var i = 0; i < itemCol.length; i += 15 )
			{
				$(itemCol.slice(i, i+ 15)).equalizeHeights();
			}
			
			var itemCol = $('.corusel-list .item .cost');
			for( var i = 0; i < itemCol.length; i += itemCol.length ){
				$(itemCol.slice(i, i + itemCol.length)).equalizeHeights();
			}

		}
	}
}

if (!funcDefined("producstListEqualizHeights"))
{
	var producstListEqualizHeights = function ()
	{
		if( $('.product-list-items').html() != undefined )
		{
			if ($(window).width()>=400)
			{
				var textWrapper = $(".product-list-items .item .item-title").height();
				var textContent = $(".product-list-items .item .item-title a");
				$(textContent).each(function()
				{
					if ($(this).outerHeight()>textWrapper) 
					{
						$(this).text(function (index, text) { return text.replace(/\W*\s(\S)*$/, '...'); });
					}
				});	
				
				var itemCol = $('.product-list-items .item-title');
				for( var i = 0; i < itemCol.length; i += itemCol.length ){
					$(itemCol.slice(i, i + itemCol.length)).equalizeHeights();
				}
				
				var itemCol = $('.product-list-items .cost');
				for( var i = 0; i < itemCol.length; i += itemCol.length ){
					$(itemCol.slice(i, i + itemCol.length)).equalizeHeights();
				}

			}
		}
	}
}

$(document).ready(function()
{

	carouselEqualizeheights();
	producstListEqualizHeights();
	orderActions();
	InitOrderCustom();

	BX.addCustomEvent(window, "onAjaxSuccess", function(){
		orderActions();
		InitOrderCustom();
	});
	
	if(jQuery.browser.mobile)
	{
		window.console&&console.log("mobile browser detected");

		$('#header .phone-block').addClass("mobile-phone-call");
		$('#footer .phone-block').addClass("mobile-phone-call");
		
		$('#header .phone-block').on("click", function() { phoneCall(this); });
		$('#footer .phone-block').on("click", function() { phoneCall(this); });
	}
	
	$('.drop-head').live('click', function(e)
	{
		e.preventDefault();
		$(this).toggleClass('open').parent().find('.form-block').toggle();
	})
	

	$('.articles-list .item .left-data .thumb').hover(
		function(){$(this).animate({'opacity':'0.7'},200);},
		function(){$(this).animate({'opacity':'1'},200);}
	);
	
	$('.main-filter-tabs  .tabs-head').delegate('li:not(.cur)', 'click', function() 
	{
		$(this).addClass('cur').siblings().removeClass('cur')
		.parents('.main-filter-tabs').find('div.box').eq($(this).index()).addClass('visible').siblings('div.box').removeClass('visible');
	})
	
	$('.to-pick-help').on('click', function(e)
	{
		e.preventDefault();
		if( $(this).hasClass('tyres') ){
			$('input#tyres').click();
		}else{
			$('input#wheels').click();
		}
		$('.main-filter-tabs  .tabs-head li.car').click();
	})
	
	$('input, textarea').placeholder();
	
	
	$('div.big_phone').hover(function(){
				$(this).parent().find('a.callback').css('background-position','-66px 0');
				},function(){
				$(this).parent().find('a.callback').css('background-position','-42px 0');
				}
	);
	
	$('a.callback').hover(function()
	{
				$(this).css('background-position','-66px 0').parent().find('div.big_phone').addClass('hov');
				},function(){
				$(this).css('background-position','-42px 0').parent().find('div.big_phone').removeClass('hov');
				}
	);
	

	$(window).scroll( function() 
	{
		if( $(this).scrollTop() > 0 ){
			$('.scroll-to-top').fadeIn();
		}else{
			$('.scroll-to-top').stop().fadeOut();
		}
	});

	$('.scroll-to-top').on('click', function() 
	{

		$('html, body').animate({scrollTop : 0}, 200); 
		return false;
	});
	
	$("#footer .up-to").on('click', function() 
	{
		 $('html, body').animate({scrollTop:0}, 'fast');
	});
	
	$('form div.r div.error:eq(0)').css("width","120px");
	
	jqmEd( 'callback', arTiresOptions['CALLBACK_FORM_ID']);
	jqmEd( 'enter', 'auth');
	jqmEd( 'order-button', arTiresOptions['PRODUCT_REQUEST_FORM_ID']);

	$('.counter').live('change', function(e)
	{
		var val = $(this).val();
		$(this).parents(".item").find(".to-cart").attr('data-quantity',val);
		$(this).parents(".cost-cell").find(".to-cart").attr('data-quantity',val);
	});
	
	$('ul.manufacturers-list:not(:last)').append('<hr/>');
	
	$('table.shell').find('.to-cart').attr('data-quantity',$('#counter').val());
	
	$('.to-cart').live( 'click', function(e){
		e.preventDefault();
		var val = $(this).attr('data-quantity');
		var item = $(this).attr('data-item');
		$(this).parent().parent().find('.in_card.item_'+item+' .count').text(val);

		markProductAddBasket(item);

		$.get( arTiresOptions['TIRES_SITE_DIR']+"ajax/add_item.php?item="+item+"&quantity="+val, 
			$.proxy
			(
				function(data) {
					jsAjaxUtil.InsertDataToNode(arTiresOptions["TIRES_SITE_DIR"]+'ajax/show_basket_line.php', 'basket_line', false);
					reloadPopupBasket('card_popup');
				}
			)
		);
	})		
})