/*
	This file is about to handle the element books,
	which shows a book list by ajax. This works a little like that:

	There is two data properties in .ap-books : data-gender and data-search,
	This two attrs are binded to the gender menu and the search input values

	The functions getBooks asks to ajax to bring all books based on our query,
	if there is no gender and no search, ajax will bring all the books
*/
(function(){
	if( ! $(".ap-books").length ) return 0;
	/*
		INIT : SEE THE FUNCTIONS BELOW 
	*/
	getBooks();	
	/*
		================================================================
		VIEW BEHAVIOR BINDINGS
		================================================================
	*/
	$("body").on("keyup", "#search-books-input", function(){
		var searchto = $(this).val();
		$(".ap-books").attr("data-search", searchto);		
	});
	/*
		SHOW BOOKS GENDERS CONTROLS BEHAVIOR
	*/
	$("body").on("click", ".ap-books-controls li a.gender", function(e){
		e.preventDefault();
		if( $(this).hasClass("active") ){
			// clears all actives classes
			$(this.nodeName).each(function(){ $(this).removeClass("active") });
			// removes the active class on clicked elem
			$(this).removeClass("active");
			// define the data-gender
			$(".ap-books").attr("data-gender", "");
		} else {
			// clears all actives classes
			$(this.nodeName).each(function(){ $(this).removeClass("active") });
			// add the active class on clicked elem
			$(this).addClass("active");
			// define the data-gender
			var gender = $(this).data("search");
			$(".ap-books").attr("data-gender", gender);
		}
		// reload the books results
		clsPage();
		getBooks(true);
	});
	/*
		BINDS THE GENDERS, SEARCH AND LOAD MORE FORMS TO
		RETURN THE GET BOOKS AJAX FUNC
	*/
	$("body").on("submit", "#form-search-books", function(e){
		e.preventDefault();
		clsPage();
		getBooks(true);
	});
	$("body").on("submit", "#form-load-more-books", function(e){
		e.preventDefault();
		incPage();
		getBooks();
	});
	/* 
		BOOK-FLIP BOOK ACTION
	*/
	$("body").on("click", ".cover-flip", function(e){
		if(! window.getSelection().toString() 
			&& $(e.target)[0].tagName != "BUTTON" 
			&& $(e.target)[0].tagName != "SPAN"
			&& $(e.target)[0].tagName != "I"
			&& $(e.target)[0].tagName != "A"
			&& $(e.target)[0].tagName != "B"
		)
		$(this).parents(".book__content").toggleClass("flipped");
	});
	$("body").on("click", ".book-flip", function(e){
		$(this).parents(".book__content").toggleClass("flipped");
	});	
	/*
		CLASS THAT CLEARS THE SEARCH ELEMENT STATE
	*/
	$("body").on("click", ".ap-books-clear-search", function(){
		clearSearchState();
	});
	/*
		================================================================
		DATA HANDLE AND RENDERING
		================================================================
	*/
	var template = $('#book-template').html();
	Mustache.parse(template);
	/*
		FUNCTION THAT GETS ALL THE BOOKS
	*/
	function getBooks( clear ){
		var gender = $(".ap-books").attr("data-gender");
		var search = $(".ap-books").attr("data-search");
		var page = $(".ap-books").attr("data-page");
		if ( clear == true ) $("#books-results-container").html("");
		//
		unsetEmpty();
		setLoading();
		// AJAX
		$.ajax({
			url: "ajax/getBooks",
			type: "GET",
			data:{
				gender: gender,
				search: search,
				page: page
			},
			success: function(data){
				data = JSON.parse(data);
				if( data.books.length > 0 ){
					$.each(data.books, function(index, book) {
						/* DESCRIPTION TRUNC */
						book.truncDescription = book.description.substr(0,260) + "...";
						/* PARSE OBJCTS FROM DB */
						book.files = JSON.parse( book.files );
						book.author.author_options = JSON.parse( book.author.author_options );
						/* STRINGFYED VERSION OF ITSELF */
						book.stringfyed = JSON.stringify(book);
						/* RENDERS THE BOOK */
						renderBook( book );
					});
				} else {
					if( clear ) setEmpty();
				}
				unsetLoading();
				checkLastPage( data.pages );
			}
		});
	}
	/* 
		FUNCTION THAT RENDERS A BOOK
		- data must be the json data to render
		- clear : clears the result wrraper before append - default is not
	*/
	function renderBook(data){
		var rendered = Mustache.render(template, data);
		$("#books-results-container").append(rendered);
	}
	/* 
		SETS THE PAGE OF RESULTS
	*/
	function incPage(){
		var p = $(".ap-books").attr("data-page");
		$(".ap-books").attr("data-page", Number(p)+1);
	}
	function clsPage(){
		$(".ap-books").attr("data-page", "1");		
	}
	/*
		MANAGE THE LOADING STATE
		AND EMPTY STATE
	*/
	function setLoading(){
		$(".ap-search-field").addClass("disabled");
		$(".ap-books-controls").addClass("disabled");
		$(".books-load-more").addClass("loading");
		//
	}
	function unsetLoading(){
		$(".ap-search-field").removeClass("disabled");
		$(".ap-books-controls").removeClass("disabled");
		$(".books-load-more").removeClass("loading");
		//
	}
	function setEmpty(){
		if(  $(".ap-books").attr("data-search").length )
			$(".search-term").html( " para "+$(".ap-books").attr("data-search") );
		if(  $(".ap-books").attr("data-gender").length )
			$(".gender-term").html( " no gênero "+$(".ap-books").attr("data-gender") );
		$(".ap-books-empty-warning").removeClass("hidden");
	}
	function unsetEmpty(){
		$(".ap-books-empty-warning").addClass("hidden");	
	}
	/*
		CLEAR THE SEARCH STATE
	*/
	function clearSearchState(){
		clsPage();
		unsetEmpty();
		unsetLoading();
		$("#form-load-more-books").show();
		$("#search-books-input").val("");
		$(".ap-books").attr("data-search", "");
		$(".ap-books").attr("data-gender", "");
		$(".ap-books-controls li a.gender").each(function(){ $(this).removeClass("active") });
		getBooks(true);
	}
	/*
		CHECK THE LAST PAGE AND OTHER RELATED STUFF
	*/
	function checkLastPage(pages){
		if( pages.books.nextPage ){
			$("#form-load-more-books").show();
		} else {
			$("#form-load-more-books").hide();
		}
	}	
})();