(function(){

	/*
		Not run if has no book-details
	*/
	if(!$(".ap-book-details").length) return 0;

	//=========================================================================
	// VARS
	//=========================================================================
	
	var $bookDetails = $(".ap-book-details");


	// =========================================================================
	// FUNCTIONS
	// =========================================================================

	/* 
		FUNCTION THAT RENDERS A BOOK BASED ON A URL QUERY B=ASBN
		Opens a book-details from a query string (ajax or store data)
	*/
	function renderBookFromUrlUrl(){
		var bookQuery = getUrlParameterByName("b") || window.location.hash.replace("#", "");
		if( bookQuery && bookQuery != "AuthorsList" ){
			var data;
			// replace # for ?b= query to before show the book (if has a hash)
			if(window.location.hash) window.history.replaceState(null, document.title, "/?b="+bookQuery);
			// get the book data from session store or ajax
			if( sessionStorage.getItem('book_'+bookQuery) ){
				data = JSON.parse( sessionStorage.getItem('book_'+bookQuery) );
				if( data.length ) mountBookFromUrl(data);
			} else {	
				$.get("ajax/getBookByAsbn/"+bookQuery, function(bookdata){
					if(bookdata.length){
						sessionStorage.setItem('book_'+bookQuery, bookdata);
						data = JSON.parse(bookdata);
						mountBookFromUrl(data);
					}
				});
			}
			// mount the book data from url to screen
			function mountBookFromUrl(data){
				if( data.length ){
					data = data[0];
					if( data.author.author_options.allow_public_emails != "1" ) delete data.author["author_email"];
					renderBookDetails( data );
				} else {
					window.history.replaceState(null, document.title, "/");
				}
			}
		}
	}
	/*
		FUNCTION THAT RENDERS A BOOK BASED ON A GIVEN DATA
		Opens a book-details with a given data rendered
	*/
	function renderBookDetails( data ){
		if( typeof data.files == 'string') data.files = JSON.parse(data.files);
		if( typeof data.author.author_links == 'string') data.author.author_links = JSON.parse(data.author.author_links);
		if( typeof data.author.author_options == 'string') data.author.author_options = JSON.parse(data.author.author_options);
		if( data.author.author_options.allow_public_emails != "1" ) delete data.author["author_email"];
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
			/* INCREASE THE BOOK VIEWS */
			$.post( "ajax/increaseBookView/"+data.asbn );
		});
	}
	/*
		Closes book function
	*/
	function closeBookDetails(){
		setTimeout(function(){		
			$(".info-side__review").removeClass('expanded');
		}, 600);
		$bookDetails.removeClass("active");
		$("body").removeClass('overflow-hidden');
		$(".ap-support.ap-support-open").removeClass("ap-support-open").length ||
		$(".ap-mail-to.ap-mail-to-open").removeClass("ap-mail-to-open").length ||
		$(".ap-author-details.about-author-open").removeClass("about-author-open").length ||
		$(".ap-book-details.cover-expand").removeClass("cover-expand").length ||
		$(".ap-contact.ap-contact-open").removeClass("ap-contact-open").length;
	}
	/*
		Removes the click here circle on deatil hover
	*/
	function removeClickReview(){
		$(".info-side__click-review").css({
			'opacity': '0'
		});
	}

	// =========================================================================
	// LOGIC
	// =========================================================================

	/*
		RENDER BOOK FROM URI QUERY ON LOAD PAGE (ajax or session store)
		OR RENDER A BOOK WHEN A URL STATE CHANGES TO A BOOK URI QUERY
	*/
	renderBookFromUrlUrl();	
	/*
		RE RENDER A BOOK WHEN URL QUERY CHANGES TO A BOOK ID ON POP STATE (Backbutton)
		This is to able the book-details to reopen on history state gets back event
	*/	
	$(window).on("popstate", function(){
		if( getUrlParameterByName("b") ){
			var bookAsbn = getUrlParameterByName("b");
			renderBookFromUrlUrl();
		} else {
			closeBookDetails();	
		}
	});
	/*
		RENDER BOOK FROM HTML DATA-BOOK ON BOOK CLICK (static)
		Show Book Detail Button (.ap-book-view)
	*/
	$("body").on("click", ".ap-book-see", function(e){
		e.preventDefault();
		/* PREVENT EVENT DELEGATION IF BOOK SEE HAVES PROPER CLASS */
		if( $(this).hasClass("ap-book-see-scoped") && !e.target.classList.contains("ap-book-see") ) return 0;
		/* GET THE DATA JSON FROM ATTR DATA */
		data = $(this).parents(".book").data("book");
		renderBookDetails( data );
		window.history.pushState(data, data.title, "?b="+data.asbn);
	});	
	/* 
		Closes BookDetails (.ap-book-close)
	*/
	$("body").on("click", ".ap-book-close", function(e){
		closeBookDetails();
		window.history.pushState(null, document.title, "/");
	});
	/*
		Expand Book Cover Button
	*/
	$("body").on("click", ".expand-book-cover", function(){
		if( window.innerWidth > 500 ){
			$(".ap-book-details").toggleClass("cover-expand");
			$('.ap-author-details').removeClass("about-author-open");
			$('.ap-mail-to').removeClass("ap-mail-to-open");
			$('.ap-support').removeClass("ap-support-open");
		}
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