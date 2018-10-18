(function(){
	/* 
		AOS ANIMATIONS PLUGIN INIT 
	*/
	if( typeof AOS !== 'undefined' ) AOS.init();
	/* 
		AUTOMATIC DIV BACKGROUND FROM [DATA-BG] AND [DATA-BG-OVERLAY] ATTR 
		Put the background image in the folder webroot/img/bg 
		and use [data-bg="imagename.ext"] To set the image as the element background
	*/
	function putBg( elem, has_overlay ){
		var url = '../img/bg/',
		overlay = '';
		if( has_overlay ){
			overlay = 'linear-gradient( rgba(0,0,0,.6), rgba(0,0,0,.6), rgba(0,0,0,.6)),';
			url += $(elem).attr('data-bg-overlay');
		} else {
			overlay = "";
			url += $(elem).attr('data-bg');
		};
		$(elem).css({
			'background': 
				overlay+'url("'+url+'") no-repeat center center',
			'background-size':
				'cover',
		});		
	}
	//
	$('[data-bg-overlay]').each(function(){
		putBg( this, true );
	});
	$('[data-bg]').each(function(){
		putBg( this, false );
	});	
	/* DOODLE */
	$('[data-doodle]').each(function(){
		var url = '../img/doodle/' + $(this).attr('data-doodle');
		$(this).css('background', 'url("'+url+'") no-repeat center center');		
	});	
	/* 
		SPOTLIGHT :: LIGHT EFFECT ON OPPENING WITH RADIAL GRADIENT
		Update the radial gradient to the mouse point on moving
		@ Use the .spotlight class to the effect, and data-spotlight to show a bg image
		@ Use .softc class to turn the effect lighten
		The spotlight function receives x and y param, which are the mouse coord x
		and mouse coord y in % - if not passed, the light 
	*/
	function spotlight( $element, mouseMoveEvent ){
		$element.each(function(){
			// config vars
			var   light_color 	   = 'rgba(55,55,55,.3)',
				  light_size	   = '500px',
				  background_color = 'rgba(0,0,0,.9))',
				  linear_gradient  = 'linear-gradient( rgba(0,0,0,.6), rgba(0,0,0,.6), rgba(0,0,0,.6))';
			// dont change those vars
			var bg = $(this).attr('data-spotlight'),
			windowWidth = $(window).width(),
			windowHeight = $(window).height(),
			x = 50;
			y = 50;
			if(mouseMoveEvent){
				x = Math.round(mouseMoveEvent.pageX / windowWidth * 100),
				y = Math.round(mouseMoveEvent.pageY / windowHeight * 100); 
			}
			// the magic
			$(this).css({
				'background': 
					linear_gradient+','
					+'radial-gradient( circle '+light_size+' at ' + x + '% ' + y + '%, '+light_color+', '+background_color
					+', url(../img/bg/'+bg+') no-repeat center center',
				'background-size':
					'cover',
			});
		});
	};
	// on mouse move, show spotlight on home
	isSafari = !!navigator.userAgent.match(/Version\/[\d\.]+.*Safari/)
	if($('.spotlight').length>0){
		$('.spotlight').each(function(){
			spotlight( $(this), false );	
		});	
		if( ! isSafari )
			$('.spotlight').mousemove(function(e){
				spotlight( $(this), e );	
			});
	};
	/* 
		BINDS THE OPACITY OF A GIVEN ELEMENT TO THE SCROLL
		as user scrolls down, the element passad loses its
		opacity in the same percent, better effect with 
		height >= 100vh elements. better if is the first
		page div 
		@put the .scroll-fade-out class to the element
	*/
	$('.scroll-fade-out').each(function(elem){
		var $elem = $(this);
		var range = 300;
		$(window).on('scroll', function () {
			// vars & calcs
			var scrollTop = $(this).scrollTop(),
			height = $elem.outerHeight(),
			offset = height / 2,
			calc = 1 - (scrollTop - offset + range) / range;
			// logic
			$elem.css({ 'opacity': calc });
			if (calc > '1' || scrollTop == 0 ) {
				$elem.css({ 'opacity': 1 });
			} else if ( calc < '0' ) {
				$elem.css({ 'opacity': 0 });
			}
		});
	});
	/* 
		SWIPER SLIDER PLUGIN
	*/
	if( typeof Swiper !== 'undefined'){
		var swiper_about = new Swiper('.swiper-about', {
			slidesPerView: 'auto',
			grabCursor: true,
			navigation: {
				nextEl: '.ap-about__controls-next',
				prevEl: '.ap-about__controls-prev',
			},
		});
	}
})();