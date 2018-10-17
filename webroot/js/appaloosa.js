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
	function spotlight( $element ){
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
			if(event){
				x = Math.round(event.pageX / windowWidth * 100),
				y = Math.round(event.pageY / windowHeight * 100); 
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
	if($('.spotlight').length>0){
		$('.spotlight').each(function(){
			spotlight( $(this) );	
		});	
		$('.spotlight').each(function(){
			$(this).mousemove(function(){
				spotlight( $(this) );	
			});
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
		JUSTIFY SPECIAL TO UL MENUS 
		@structure:
		<div class="your-wrapper" style="must have height and width">
			<div class="justify-special">
				<ul>
					<li><a href="/"><div>A</div></a></li>
					<li><a href="/"><div>B</div></a></li>
					<li><a href="/"><div>C</div></a></li>
					<li><a href="/"><div>D</div></a></li>
					<li><a href="/"><div>E</div></a></li>
					<li><a href="/"><div>F</div></a></li>
				</ul>
			</div>
		</div>
	*/
	function justifyProportional(){
		var $wrapper = $('.justify-proportional');
		// initial style
		$wrapper.find("ul li").css({
			"width": "fit-content",
			"line-height": "1",
			"font-size": "1px"
		});
		// the magic
		$wrapper.find('ul li a div').each(function(){
			var c = 0;
			while( $(this).innerWidth() < ($wrapper.innerWidth() - 45) ){
				c++;
				$(this).css({
					"font-size": c+'px'
				});
				// secure break if had some fail on calc the sizes
				if(c > $wrapper.innerWidth()) break;
			}
		});
	}
	if( $('.justify-proportional').length>0 ){
		$(window).on( "resize", function(){
			setTimeout(justifyProportional(),500);
		});
		justifyProportional();
	}	
	/* 
		JUSTIFY ONMAX
		keep increasing font size ultil contant and container have same width
		@structure
		<div class="justify-onmax">
			<div class="justify-onmax__list">
				<ul>
					<li><a href="/"><div>A</div></a></li>
					<li><a href="/"><div>B</div></a></li>
					<li><a href="/"><div>C</div></a></li>
					<li><a href="/"><div>D</div></a></li>
					<li><a href="/"><div>E</div></a></li>
					<li><a href="/"><div>F</div></a></li>
				</ul>
			</div>
		</div>
	*/
	(function(){
		var $wrapper = $('.justify-onmax');
		// initial style
		$wrapper.find(".justify-onmax__list ul").removeAttr("style").css({
			"width": "fit-content",
			"padding": "10%",
			"padding-top": "6px",
			"font-size": "1px",
			"margin-left": "-4px"
		});
		// the magic
		$wrapper.find('.justify-onmax__list').each(function(){
			var c = 0;
			while( $(this).innerWidth() < ($wrapper.innerWidth()) ){
				c++ * 4;
				$(this).find("*").css({
					"font-size": c+'px'
				});
				// secure break if had some fail on calc the sizes
				if(c > $wrapper.innerWidth()) break;
			}
		});
	})();
	/* 
		SEARCH TOGGLE BTN 
		Toggle search input to ap-search-field classes
	*/
	$('.ap-search-field-toggle').each(function(){
		var $searchField = $(this);
		$searchField.find('.search-toggle').on('click', function(e){
			e.preventDefault();	
			$searchField.toggleClass('active');	
			$searchField.find('.search-input').focus();	
			/* SEARCH INPUT FOCUS OUT HANDLER */
			$searchField.find('.search-input').on('focusout', function(e){	
				/* 
					see which elem stoled the focus; if was stolen by the 
					.search-toggle, which is the search button <a>,
					the focusout will take no action, otherwise, the
					focusout will perform an input hide. this keep the
					input event handler separed from .search-toggle event
					handler. the .event-toggle must be a <a> element, which
					will always be returned in the relatedTarget to keep
					security, other elements could return null. if not here
					the focuslost is triggered before any button events
					trapping the search input state */
				var a = e.relatedTarget;
				var b = $searchField.find('.search-toggle')[0];
				if( a != b ){
					$searchField.removeClass('active');	
				}
			});
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