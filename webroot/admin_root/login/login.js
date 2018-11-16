(function(){
	$(".ap-login").find("form.login-form").on("submit", function(e){
		e.preventDefault();
		var $form = $(this);
		var email = $("#email").val();
		var pass = $("#pass").val();
		// set form to loading
		$form.parents(".login-box").addClass('loading');
		//
		$.ajax({
			url: $form.attr("action"),
			type: "POST",
			data: {
				"email" : email,
				"pass" : pass
			},
			success: function( data ){
				/*
					the login ajax will return 0 to not logged
					or 1 to succesfuly logged
				*/
				if( data == 1 ){
					// refresh and cake controller will do the handle
					location.reload();
				} else {
					$form.parents(".login-box")
					.addClass('shake')
					.one('webkitAnimationEnd oanimationend msAnimationEnd animationend', function(e) {
						$(this).removeClass("shake loading");
					});
				}
			},
			error: function(jqXHR, txtStatus, errorThrown){
				$form.parents(".login-box").removeClass('loading');
                console.log('Ajax status: '+txtStatus+" - "+errorThrown);
			}
		});
	});
})();