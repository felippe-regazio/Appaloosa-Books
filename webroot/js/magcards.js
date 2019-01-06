(function(){

	var MagApiAddress = "magazine?rest_route=/wp/v2/posts/&_embed&filter[status]=publish";

	/*
		Not run if has no magcards
	*/
	if(!$(".magcards").length) return 0;

	var $magcards = $(".magcards");
	var $postswrapper = $magcards.find(".swiper-wrapper");
	/* Put things to work */
	$(window).ready(function(){
		loadMagPosts();
	});
	/* Get posts From WP Magazine and store in a local Cache */
	function loadMagPosts(){
		var data;
		if( sessionStorage.getItem("magposts-items") ){
			data = JSON.parse(sessionStorage.getItem("magposts-items"));
			renderMagPosts(data);
		} else {

			$.ajax({
				url: MagApiAddress,
				method: "GET",
				dataType: "json",
				success: function(data){
					if(data){
						sessionStorage.setItem("magposts-items", JSON.stringify(data));
						renderMagPosts(data);
					} else {
						$postswrapper.removeClass("loading").addClass("empty");
					}
				},
				error: function(err){
					$("section.magcards").remove();
					console.log(err.responseJSON);
					console.warn("Error while getting magazine cards: "+err.status+" "+err.statusText+" - The Magazine Cards session wont be showed.");
				}
			});
		}
	}
	/* Show the posts on screen */
	function renderMagPosts(data){
		var rendered = "";
		var template = $magcards.find("template").html();
		Mustache.parse(template);
		$.each( data, function(index, value){
			// insert a virtual key with the featured image
			if(data[index]._embedded['wp:featuredmedia']['0'].media_details.sizes["medium-large"] != undefined){
				data[index].featured_image = data[index]._embedded['wp:featuredmedia']['0'].media_details.sizes["medium-large"].source_url;
			} else {
				data[index].featured_image = data[index]._embedded['wp:featuredmedia']['0'].source_url;
			};
			// truncate the title
			if( data[index].title.rendered.length > 80 ){
				data[index].title.rendered = data[index].title.rendered.substring(0, 80) + "...";	
			}
			// renders the card
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