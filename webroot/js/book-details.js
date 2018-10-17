(function(){
	var $bookDetails = $(".ap-book-details");
	/* Common Call Back Events When Closes*/
	function BookDetailsCloseEvents(){
		setTimeout(function(){		
			$(".info-side__review").removeClass('expanded');
		}, 600);
	};
	/*
		If there is a hash on the url, see if its a book
	*/
	var bookHash = window.location.hash.replace("#", "");
	if( bookHash && bookHash != "authorsList" ){
		$.get("ajax/getBookByAsbn/"+bookHash, function(data){
			data = JSON.parse(data);
			/* PARSE OBJCTS FROM DB */
			data = data[0];
			data.files = JSON.parse( data.files );
			data.author.author_options = JSON.parse( data.author.author_options );
			if( data ){
				console.log(data);
				if( data.author.author_options.allow_public_emails != "1" ) delete data.author["author_email"];
				renderBookDetails( data );			
			} else {
				window.history.replaceState({}, document.title, "/");
			}
		});
	}	
	/*
		Show Book Detail Button (.ap-book-view)
	*/
	$("body").on("click", ".ap-book-see", function(e){
		e.preventDefault();
		/* GET THE DATA JSON FROM ATTR DATA */
		data = $(this).parents(".book").data("book");
		if( data.author.author_options.allow_public_emails != "1" ) delete data.author["author_email"];
		console.log(data);
		renderBookDetails( data );
	});
	/*
		Opens a book-details with a given data rendered
	*/
	function renderBookDetails( data ){
		var template = $('#ap-book-details-template').html();
		Mustache.parse(template);
		var rendered = Mustache.render(template, data);
		$.when( $("#ap-book-details-template-wrapper").html(rendered) ).then( function(){
			/* SHOW THE VIEW */
			$bookDetails.removeClass("cover-expand");
			$bookDetails.addClass("active");
			$("body").addClass('overflow-hidden');
			/* CHECK IF REVIEW WILL BE EXPANDED OR NOT */
			if($( ".info-side__review-roll").html().length < 700 ){
				$(".info-side__review").addClass("expanded");	
			}
			/* IF ON MOBO, ROLLS THE SCROLL A LITTLE */
			if( window.innerWidth <= 800 ){
				setTimeout(function(){
					$("#ap-book-details-template-wrapper").animate({
			        	scrollTop: $("#ap-book-details-template-wrapper")[0].scrollHeight / 3.5
			    	}, 1000);
				}, 425);
			}
			/* UPDATE URL WITH THE HASH */
			window.location.hash = data.asbn;
			/* INCREASE THE BOOK VIEWS */
			$.post( "ajax/increaseBookView/"+data.asbn );
		});
	}
	/* 
		Closes BookDetails (.ap-book-close)
	*/
	$("body").on("click", ".ap-book-close", function(e){
		BookDetailsCloseEvents();
		$bookDetails.removeClass("active");
		$("body").removeClass('overflow-hidden');
		window.history.replaceState({}, document.title, "/");
	});
	/*
		Expand Book Cover Button
	*/
	$("body").on("click", ".expand-book-cover", function(){
		if( window.innerWidth > 500 )
			$(".ap-book-details").toggleClass("cover-expand");
			$('.ap-author-details').removeClass("about-author-open");
			$('.ap-mail-to').removeClass("ap-mail-to-open");
			$('.ap-support').removeClass("ap-support-open");
	});
	/* 
		Click icon to follow cursor on Review Roll Hover;
	*/
	$("body").on("mousemove", ".info-side__review", function(e){
		if( window.innerWidth > 768 ){
			if(!$(".info-side__review").hasClass('expanded')){
				var x = e.offsetX+"px",
					y = e.offsetY+"px";
				$(".info-side__click-review").css({
					'left': x,
					'top': y,
					'opacity':'.8',
					'position': 'absolute'
				});
			} else {
				removeClickReview();	
			}
		}
	});
	$("body").on("mouseleave", ".info-side__review", function(){
		removeClickReview();
	});
	function removeClickReview(){
		$(".info-side__click-review").css({
			'opacity': '0'
		});
	}
	/*
		Expand/Contract Review RollDown on Click
	*/
	$("body").on("click", ".info-side__review", function(e){
		/* check if was not a selection text action, 
		then toggle the class */
		if( !window.getSelection().toString() )
		$(this).toggleClass('expanded');
		removeClickReview();
	});
	/*
		Expand/Contract Review RollDown on Arrow Click
	*/
	$("body").on("click", ".info-side__review-more", function(e){
		$('.info-side__review').toggleClass('expanded');
	});
})();