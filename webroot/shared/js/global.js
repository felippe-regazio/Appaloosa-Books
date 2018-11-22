/*
	Page general loading function
*/
var waitToShowLoading = 1500;
setTimeout(function(){
	$("body.loading").addClass("wait");
}, waitToShowLoading);
$(window).on("load", function(e){
	$.when($("body").removeClass("loading wait")).then(function(){
		setTimeout(function(){
			$("body").removeClass("fadeIn");
		}, 500);
	});
});
/*
	Close cascade hierarchy function. This events close
	An oppened page tile following a simple hierarchy
*/
function closeCurrentTile(){
	// close sidebar bestSellers Tile
	if( $(".tile.active").removeClass("active").length && $(".ap-sidebar.put-behind").removeClass("put-behind").length ) return;
	// common screen wich can be closed no matter the order
	var commonClose =
		$(".ap-support.ap-support-open").removeClass("ap-support-open").length ||
		$(".ap-mail-to.ap-mail-to-open").removeClass("ap-mail-to-open").length ||
		$(".ap-author-details.about-author-open").removeClass("about-author-open").length ||
		$(".ap-book-details.cover-expand").removeClass("cover-expand").length ||
		$(".ap-contact.ap-contact-open").removeClass("ap-contact-open").length;
	if( commonClose ) return;
	// close book details
	if($(".ap-book-details.active").removeClass("active").length){
		$("body").removeClass("overflow-hidden");
		window.history.pushState(null, document.title, "/");
		return;
	}
	// close authors list
	if( $(".ap-authors-list.ap-authors-list-open").removeClass("ap-authors-list-open").length ){
		$("body").removeClass('overflow-hidden');
		window.history.pushState(null, document.title, "/");
		return;
	}
}
/*
	Close menus and tiles on Escape (ESC) Key
*/
$(document).keyup(function(e){
	if( e.key == "Escape" ){
		closeCurrentTile();
	}
});
/*
	Close menus and tiles on Swipe right or left
*/
closeOnSwipe = new Hammer(document);
closeOnSwipe.on('swiperight', function(){
	closeCurrentTile();
});
closeOnSwipe.on('swipeleft', function(){
	var commonClose =
		$(".ap-book-details.cover-expand").removeClass("cover-expand").length;
	if( commonClose ) return;
	// sidebar
	if($('.ap-sidebar').hasClass('active'))
	$('.ap-navbar-hamburger').trigger('click');
});