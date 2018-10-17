(function(){
	// defaults
	var defaultMsg = $(".newsletter-result-message").html();
	//
	$("body").on("submit", ".newsletter-subscribe-form", function(e){
		e.preventDefault();
		var email = $(this).find("input.newsletter-input").val();
		//
		data = $(this).serialize();	
		if( email.trim() ){
			setLoading();
			// post email to subscribe
			$.post("ajax/subscribe", data, function( data ){
				data = JSON.parse(data);
				unsetLoading();
				setMessage( data["message"] );
			});
		}
	});
	function setLoading(){
		$(".newsletter-subscribe-form").find("input").blur();
		$(".newsletter-subscribe-form").attr("disabled", true);
		$(".newsletter-subscribe-form").addClass("loading");
	}
	function unsetLoading(){
		$(".newsletter-subscribe-form").removeClass("loading");
		$(".newsletter-subscribe-form").removeAttr("disabled", true);
	}
	function setMessage( msg ){
		clsInput();
		$(".newsletter-result-message").hide().html( msg ).fadeIn("slow");
		setTimeout(function(){
			resetState();
		}, 5000 );
	}
	function resetState(){
		$(".newsletter-result-message").hide().html( defaultMsg ).fadeIn("slow");
		clsInput();
		unsetLoading();
	}
	function clsInput(){
		$(".newsletter-subscribe-form")[0].reset();
	}
})();