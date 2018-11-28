(function(){
/* 
	INITIALS
*/
$("body").ready(function(){
	setTimeout(function(){
		scrollToHash( window.location.hash );
	}, 500);
});
/* 
	DARK BACKGROUND WHICH FOLLOWS CURSOR
	this is the funcion to make the background follows the
	cursor in the hero of info page
*/
if( window.innerWidth >= 768){
	$(".info-hero__content").on("mousemove", function(e){
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
	$(".info-hero__content").on("mouseleave", function(e){
	    $(".clipfollow").css({
	    	"clip-path":
	    		"polygon(30% 0, 100% 0, 100% 100%, 30% 100%)"
	    });
	});
}
/*
	READS THE # IN THE URL
	The # represents a elem id to scroll to
*/
function scrollToHash(hash){
	if($(hash).length > 0 ){
		$("html, body").animate({
        	scrollTop: $(hash).offset().top - 120
    	}, 1000);
	}
};
/*
	READ MORE ON ARTICLES
*/
function moreLess(initiallyVisibleCharacters) {
	var visibleCharacters = initiallyVisibleCharacters;
	var paragraph = $(".read-more")
	paragraph.each(function() {
		var text = $(this).text();
		var wholeText = text.slice(0, visibleCharacters) + "<span class='ellipsis'>... <br/><br/></span><a href='#' class='more'><i class='fa fa-plus-circle' aria-hidden='true'></i> <b>Ler Mais</b></a>" + "<span style='display:none'>" + text.slice(visibleCharacters, text.length) + "<br/><br/><a href='#' class='less'><i class='fa fa-minus-circle' aria-hidden='true'></i> <b>Recolher</b></a></span>"
		if (text.length < visibleCharacters) {
			return
		} else {
			$(this).html(wholeText)
		}
	});
	$(".more").click(function(e) {
		e.preventDefault();
		$(this).hide().prev().hide();
		$(this).next().show();
	});
	$(".less").click(function(e) {
		e.preventDefault();
		$(this).parent().hide().prev().show().prev().show();
	});
};
moreLess(750);
})();