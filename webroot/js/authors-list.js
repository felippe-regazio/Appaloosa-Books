(function(){
	// Update Hash
	if( window.location.hash == "#AuthorsList" ){
		openAuthorsList();
	}
	/* 
		All Authors Show
	*/
	$("body").on("click", ".toggle-authors-list", function(e){
		e.preventDefault();
		openAuthorsList();
	});
	/*
		Useful Functions
	*/
	function openAuthorsList(){
		// ------------------------------------------------------------
		if( ! $(".ap-authors-list").hasClass("ap-authors-list-open") ){
			// If Opening
			var columns = Math.floor(window.innerWidth / 300);
			$(".ap-authors-list").addClass("loading");
			$("#authors-list-content").css({
				"column-count" : columns
			});
			window.location.hash = "AuthorsList";
		} else {
			// If Closing
			window.history.replaceState({}, document.title, "/");
		}
		// ------------------------------------------------------------
		$(".ap-authors-list").toggleClass("ap-authors-list-open");
		$("body").toggleClass('overflow-hidden');
		// if the template has never been filled
		if( ! $("#authors-list-content").children().length ){
			// if the data already exists on a session store, 
			// just render, if not, get
			if( sessionStorage.getItem('authors_list')){
					data = JSON.parse( sessionStorage.getItem('authors_list') );
					buildAuthorList( data );
			} else {
				$.get("ajax/getAuthorsNameList", function(data){
					var data = JSON.parse(data);
					// if is first access, saves this data on local storage
					if ( data && typeof(Storage) !== "undefined" ){
						sessionStorage.setItem( 'authors_list', JSON.stringify(data) );
					}
					buildAuthorList( data );
				});
			}
		} else {
			$(".ap-authors-list").removeClass("loading");
		}
	}
	function buildAuthorList( data ){
		// renders the authors
		$.each(data, function(index, author){
			var template = $('.ap-authors-list').find("template").html();
			var rendered = Mustache.render(template, author);
			Mustache.parse(template);
			$("#authors-list-content").append(rendered);
		});
		$(".ap-authors-list").removeClass("loading");
	}
})();