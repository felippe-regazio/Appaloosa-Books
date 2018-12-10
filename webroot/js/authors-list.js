(function(){

	/*
		Not run if has no authors-list
	*/
	if(!$(".ap-authors-list").length) return 0;

	/*
		On page load or On Hash Change
	*/
	if( window.location.hash == "#AuthorsList" ){
		toggleAuthorsList();
	}
	window.addEventListener("hashchange", function(){
		if( window.location.hash == "#AuthorsList" ){
			toggleAuthorsList();
		} else {
			$(".ap-authors-list").removeClass("ap-authors-list-open");
			$("body").removeClass('overflow-hidden');
		}
	});
	/*
		All Authors Show on Click
	*/
	$("body").on("click", ".toggle-authors-list", function(e){
		e.preventDefault();
		toggleAuthorsList(true);
	});
	/*
		Useful Functions
	*/
	function toggleAuthorsList( toggleHash ){
		var data = {};
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
					data = JSON.parse(data);
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
		// toggle the window hash if flagged to
		if( toggleHash ){
			if( window.location.hash == "#AuthorsList" ){
				window.history.pushState({}, document.title, "/");
			} else {
				window.history.pushState(data, "Appaloosa Books - Autores", "#AuthorsList");
			}
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
		var columns = Math.floor(window.innerWidth / 300);
			$("#authors-list-content").css({
				"column-count" : columns
		});		
		$(".ap-authors-list").removeClass("loading");
	}
})();