/**
 * General JavaScripting for the CDATwentyThirtheen theme.
 */
jQuery( document ).ready( function( $ ) {

	//Handles toggling the main navigation menu for small screens.
	
	var $masthead = $( '#masthead' ),
	    timeout = false;

	$.fn.smallMenu = function() {
		$masthead.find( '.site-navigation' ).removeClass( 'main-navigation' ).addClass( 'main-small-navigation' );
		$masthead.find( '.site-navigation h1' ).removeClass( 'assistive-text' ).addClass( 'menu-toggle' );

		$( '.menu-toggle' ).unbind( 'click' ).click( function() {
			$masthead.find( '.menu' ).toggle();
			$( this ).toggleClass( 'toggled-on' );
		} );
	};

	// Check viewport width on first load.
	if ( $( window ).width() < 600 )
		$.fn.smallMenu();

	// Check viewport width when user resizes the browser window.
	$( window ).resize( function() {
		var browserWidth = $( window ).width();

		if ( false !== timeout )
			clearTimeout( timeout );

		timeout = setTimeout( function() {
			if ( browserWidth < 600 ) {
				$.fn.smallMenu();
			} else {
				$masthead.find( '.site-navigation' ).removeClass( 'main-small-navigation' ).addClass( 'main-navigation' );
				$masthead.find( '.site-navigation h1' ).removeClass( 'menu-toggle' ).addClass( 'assistive-text' );
				$masthead.find( '.menu' ).removeAttr( 'style' );
			}
		}, 200 );
	} );
	
	//Foldout panel - Open the panel when the opener is being clicked!
	$('#foldout-panel-opener').click(function(e){
		e.preventDefault();
		$('.foldout-panel').slideToggle();
	});
	
	//PrettyPhoto - Set up the PrettyPhoto stuff to be loaded when the page is ready.
	
	var items = jQuery('div.entry-content a').filter(function() {
		if (jQuery(this).attr('href'))  
			return jQuery(this).attr('href').match(/\.(jpg|png|gif|JPG|GIF|PNG|Jpg|Gif|Png|JPEG|Jpeg)/);
	});
	if (items.length > 1) {
		var gallerySwitch="[customPP]";
	} else {
		var gallerySwitch="";
	}
	items.attr('data-rel','prettyPhoto'+gallerySwitch);
	

	//first - make sure PP is only used on non-mobile websites.
	if( !jQuery.browser.mobile ){	
		$("a[data-rel^='prettyPhoto']").prettyPhoto({
			social_tools: '<div class="prettyPhoto_links"></div>',
			overlay_gallery: false,
			default_width: 940,
			changepicturecallback: function( ){
				
				//Make sure lightbox doesn't run off the left of the screen
				var $pp = $('.pp_default');
				if( parseInt( $pp.css('left') ) < 0 ){
					$pp.css('left', 0 );
				}

				//Setup link based on {{link}} in description
				var $pp_desc = $( '.pp_description' );
				var desc = $pp_desc.text();
				var start = desc.indexOf( '{{' );
				if( start >= 0 ){
					var link = desc.substring( start + 2 , desc.indexOf( '}}' ) );
					desc = desc.substring( 0 , start );
					var anchor = '<a class="prettyPhoto-link" href="'+link+'"><i class="icon-link"></i></a>';
					$( '.prettyPhoto_links' ).html( anchor );

					$pp_desc.html( desc );
				}

			}
		});
	}
	else {
	//Mobile devises - Make sure it works here correct!
		$("a[data-rel^='prettyPhoto'][data-href-alt]").click( function(e){
			e.preventDefault();
			var href = $(this).attr( 'data-href-alt' );
			if( href ) window.location = href;
			return false;
		});
	}
	
	
} );