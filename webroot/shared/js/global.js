/*
	Escape Key closes menus and tiles
*/
$(document).keyup(function(e){
	if( e.key == "Escape" ){
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
			window.history.replaceState({}, document.title, "/");
			$("body").removeClass("overflow-hidden");
			return;
		}
	}
});