(function(){
	/* 
		About Author Show 
	*/
	$("body").on("click", ".toggle-mail-to", function(e){
		e.preventDefault();
		var authorId = $(this).attr("data-author-id");
		var bookName = $(this).attr("data-book-name");
		$(".ap-mail-to").find("#author-id").val( authorId );
		$(".ap-mail-to").find("#book-name").val( bookName );
		clearAuthorMailForm();
		$(".ap-mail-to").toggleClass("ap-mail-to-open");
	});
	/* 
		Send
	*/
	$(".ap-mail-to form").on("submit", function(e){
		e.preventDefault();
		$form = $(this);
		url = $form.attr("action");
		data = $form.serialize();
		$form.addClass("loading");
		$.post( url, data, function( data ){
			data = JSON.parse(data);
			$form.removeClass("loading");
			$form.find("p.response").fadeIn("slow").html(data.message);
			clearAuthorMailForm();
			setTimeout(function(){
				$form.find("p.response").fadeOut("slow").html("");
			}, 3000 );
		});
	});
	/*
		Clear author mail form
	*/
	function clearAuthorMailForm(){
		$("#mail-to-author input:not([type=hidden]), #mail-to-author textarea:not([type=hidden])").val("");
	}
})();