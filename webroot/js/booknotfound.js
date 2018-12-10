$(document).ready(function(e){
	if($(".booknotfound").length){
		$(document).one("scroll", function(){
			closeBookNotFound();
		});
	}
});
function closeBookNotFound(){
	$(".booknotfound").fadeOut();
	window.history.replaceState(null, document.title, '/');
	$(document).off("scroll", closeBookNotFound);
}