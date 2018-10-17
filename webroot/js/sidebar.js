(function(){
	$sidebar = $('.ap-sidebar');
	$hamburger = $('.ap-navbar-hamburger');
	/* Global Sidebar Toggle */
	$('.ap-sidebar-toggle').click(function(){
		$sidebar.toggleClass('active').focus();
		$("body").toggleClass('sidebar-open');
	});
	/* Closes on click */
	$sidebar.on('mouseleave', function(){
		/* if not ap-sidebar, ap-sidebar-toggle element on hover, closes the sbar*/
		if ($('.ap-sidebar:hover, .ap-sidebar-toggle:hover').length != 1 
			&& $sidebar.hasClass("active")
			&& ! $sidebar.find(".tile.active").length
		){
			$hamburger.trigger('click');
		}
	});
	/* divs that triggers the navbar close on click */
	$('.ap-opening, .ap-wrapper, .ap-content, .ap-navbar').click(function(){
		if($sidebar.hasClass('active'))
			$hamburger.trigger('click');
	});
	/* tile opening behavior */
	$("[data-tile]").on("click", function(e){
		e.preventDefault();
		//
		if( $(this).data("tile") == "#best-sellers" )
			loadBestSellers();
		//
		$( $(this).data("tile") ).toggleClass("active");
		$sidebar.toggleClass("put-behind");
	});
	// load data functions
	function loadBestSellers(){
		$("#best-sellers").addClass("loading");
		$.get("/ajax/getBestSellers", function(data){
			var data = JSON.parse(data);
			var template = $("#best-sellers").find("template").html();
			if( ! $("#best-sellers").find(".bests-list").html().length ){
				$.each( data.books, function( index, book ){
					/* DESCRIPTION TRUNC */
					book.truncDescription = book.description.substr(0,260) + "...";
					/* PARSE OBJCTS FROM DB */
					book.files = JSON.parse( book.files );
					book.author.author_options = JSON.parse( book.author.author_options );
					/* STRINGFYED VERSION OF ITSELF */
					book.stringfyed = JSON.stringify(book);
					book.number = index+1;
					/* RENDERS THE BOOK */
					var rendered = Mustache.render(template, book);
					$("#best-sellers").find(".bests-list").append(rendered);
				});
			}
			$("#best-sellers").removeClass("loading");
		});
	}
})();