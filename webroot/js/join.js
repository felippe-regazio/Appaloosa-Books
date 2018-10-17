(function(){
	/* 
		DARK BACKGROUND WHICH FOLLOWS CURSOR
		this is the funcion to make the background follows the
		cursor in the hero of info page
	*/
	if( window.innerWidth >= 768){
		$(".join-hero__content").on("mousemove", function(e){
			// offset to percent x%
			var offset = $(this).offset();
		    var relativeX = e.pageX - offset.left;
		    var wide = $("body").width();
		    var percent = (relativeX*100)/wide;
		    //
		    $(".clipfollow").css({
		    	"clip-path":
		    		"polygon("+(percent)+"% 0, 100% 0, 100% 100%, "+(percent)+"% 100%)"
		    });
		});
		$(".join-hero__content").on("mouseleave", function(e){
		    $(".clipfollow").css({
		    	"clip-path":
		    		"polygon(30% 0, 100% 0, 100% 100%, 30% 100%)"
		    });
		});
	}
	/*
		Password Validator
	*/
	$("#ap-join-form").on("submit", function(e){
		e.preventDefault();
		$form = $(this);
		// some validation
		if( $form.find(".pass").val() != $form.find(".pass-confirm").val() ){
			$form.find("p.response").fadeIn("slow").html("As senhas não correspondem");
			setTimeout(function(){
				$form.find("p.response").fadeOut("slow").html("");
			}, 6000 );
			return;
		}
		//
		url = $form.attr("action");
		data = $form.serialize();
		$form.addClass("loading");
		$.post( url, data, function( data ){
			data = JSON.parse(data);
			$form.removeClass("loading");
			$form.find("p.response").fadeIn("slow").html(data.message);
			setTimeout(function(){
				$form.find("p.response").fadeOut("slow").html("");
			}, 6000 );			
			if(data.status) $form[0].reset();		
		});
	});
})();