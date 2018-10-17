(function(){
	/* 
		About Author Show 
	*/
	$("body").on("click", ".toggle-author-details", function(e){
		e.preventDefault();
		var author_id = $(this).attr("data-author");
		$(".ap-author-details").toggleClass("about-author-open");
		var loadingTime = setTimeout(function(){
			$(".ap-author-details").addClass("loading");
		}, 500 );
		/* if in admin */
		if($("body").hasClass("ap-admin")) $("body").toggleClass('overflow-hidden');
		/*
			If openned a view, asks data for the Author Ajax		
		*/
		if( $(".ap-author-details").hasClass("about-author-open") ){
			$(".ap-author-details").find(".ap-loading-circle").removeClass("error");
			var data = null;
			/* 
				CHECK IF THE DATA ALREADY EXISTS AT LOCAL STORAGE
				IF YES, GET FROM THERE, IF NO, ASKS VIA AJAX 
				The local storage will be checked, if this data exists there
				will use it unless the toggle class haves a no-cache flag
			*/
			if( sessionStorage.getItem('author_data_'+author_id) && ! $(".toggle-author-details").hasClass("no-cache") ){
				data = JSON.parse( sessionStorage.getItem('author_data_'+author_id) );
				clearTimeout( loadingTime );
				buildAuthorView(data);
			} else {
				$.ajax({
					url: '/ajax/getAuthorBasicInfoById',
					type: 'POST',
					data: {
						id: author_id
					},
					success: function(data){
						data = JSON.parse(data);
						// if is first access, saves this data on local storage
						if ( data && typeof(Storage) !== "undefined" ){
							sessionStorage.setItem( 'author_data_'+author_id, JSON.stringify(data) );
						}
						// build the view
						clearTimeout( loadingTime );
						buildAuthorView(data);
					},
					error: function(jqXHR, txtStatus, errorThrown){
						clearTimeout( loadingTime );
						$(".ap-author-details").find(".ap-loading-circle").addClass("error");
					}
				});
			}
		} else {
		// this means that user is closing the author details view
			$('#about-author-holder').html("");
			$(".ap-author-details").removeClass("loading");
			$(".ap-author-details").find(".ap-loading-circle").removeClass("error");
		}
	});
	/*
		This functions mounts the author view using json data and mustache engine
	*/
	function buildAuthorView(data){
		if( data ){
			data.author_links = JSON.parse(data.author_links);
			// replace empty image to default image
			if(!data.author_image) data.author_image = "default.jpg";
			// mustache render the user
			var template = $('#about-author-template').html();
			Mustache.parse(template);
			var rendered = Mustache.render(template, data);
			$('#about-author-holder').html(rendered);
			$(".ap-author-details").removeClass("loading");
			// remove author support button in admin preview
			if( $("body").hasClass("ap-admin") ) $(".ap-author-details").find(".about-author__support").hide();
		} else {
			$(".ap-author-details").find(".ap-loading-circle").addClass("error");	
		}		
	}
})();