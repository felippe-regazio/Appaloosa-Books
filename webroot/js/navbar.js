(function(){
	var $navbar = $('.ap-navbar'),
		$window = $(window),
		prev    = $(window).scrollTop();
	/* Hides the nav on scroll if it has auto-hide class*/
	if($navbar.hasClass('auto-hide')){
		$window.on('scroll', function(){
			var scrollTop = $window.scrollTop();
			// tolerated scroll range from last prev before hides/show the nav
			var distance  = 400;
			//
			if( scrollTop > prev+distance || scrollTop < prev-distance){			
				$navbar.toggleClass('hidden', scrollTop > prev);
				prev = scrollTop;
			}
		});
	}
	/* ap-navbar-menu-toggle .close-mode class toggle */
	$('.ap-navbar-hamburger').click(function(e){
		$(this).toggleClass('close-shape');
	});
})();