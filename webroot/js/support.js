(function(){
	var pagSeguroUrl = "https://pagseguro.uol.com.br/checkout/v2/donation.html?currency='BRL'&receiverEmail=";
	/* 
		About Author Show 
	*/
	$("body").on("click", ".toggle-support", function(e){
		e.preventDefault();
		var email = $(this).attr("data-author-pg");
		$(".ap-donation-link").attr("href", pagSeguroUrl + email);
		$(".ap-support").toggleClass("ap-support-open");
	});
})();