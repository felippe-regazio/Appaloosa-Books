(function(){
	var $magcards = $(".magcards");
	var $postswrapper = $magcards.find(".swiper-wrapper");
	/* Put things to work */
	$(window).ready(function(){
		loadMagPosts();
	});
	/* Get posts From WP Magazine */
	function loadMagPosts(){
		$.get("magazine?rest_route=/wp/v2/posts/", function(data){
			if(data){
				renderMagPosts(data);
			} else {
				$postswrapper.removeClass("loading").addClass("empty");
			}
		});
	}
	/* Show the posts on screen */
	function renderMagPosts(data){
		console.log(data);
		var rendered = "";
		var template = $magcards.find("template").html();
		Mustache.parse(template);
		$.each( data, function(index, value){
			if(value != undefined && index != undefined){
				rendered += Mustache.render(template, data[index]);
			}
		});
		$.when( $postswrapper.html(rendered) ).then( function(){
			$postswrapper.removeClass("loading");
			newSwiper(".magcards-swiper");
		});
	}
})();