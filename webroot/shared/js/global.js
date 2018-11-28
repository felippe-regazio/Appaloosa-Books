/* 
	Store the page default meta image and description
*/
var defaultmetas = {};
defaultmetas.title = document.title;
defaultmetas.image = $("meta[name=image").attr("content");
defaultmetas.description = $("meta[name=description").attr("content");
/*
  LOADING
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
  COMMON CLOSE FUNCTION QUEUE
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
		resetMetatags(defaultmetas);
		return;
	}
	// close authors list
	if( $(".ap-authors-list.ap-authors-list-open").removeClass("ap-authors-list-open").length ){
		$("body").removeClass('overflow-hidden');
		return;
	}
}
/*
  ESCAPE (ESC)
	Close menus and tiles on Escape (ESC) Key
*/
$(document).keyup(function(e){
	if( e.key == "Escape" ){
		closeCurrentTile();
	}
});
/*
  SWIPING HANDLES
	Close menus and tiles on Swipe right or left
*/
$(document).swipe( {
  preventDefaultEvents: false,
  // On Swipe Right
  swipeRight:function() {
    if( window.getSelection().toString() == "" ){
			closeCurrentTile();
    };
  },
  // On Swipe Left
  swipeLeft:function() {
    if( window.getSelection().toString() == "" ){
			var commonClose =
				$(".ap-book-details.cover-expand").removeClass("cover-expand").length;
			if( commonClose ) return;
			// sidebar
			if($('.ap-sidebar').hasClass('active'))
			$('.ap-navbar-hamburger').trigger('click');
    };
  }
});
/*
  REMOVE ALL :HOVER CSS STYLE ON MOBO
  This will remove the css :hover effects on mobile
*/
function hasTouch() {
    return 'ontouchstart' in document.documentElement
           || navigator.maxTouchPoints > 0
           || navigator.msMaxTouchPoints > 0;
}
if (hasTouch()) { // remove all :hover stylesheets
    try { // prevent exception on browsers not supporting DOM styleSheets properly
        for (var si in document.styleSheets) {
            var styleSheet = document.styleSheets[si];
            if (!styleSheet.rules) continue;

            for (var ri = styleSheet.rules.length - 1; ri >= 0; ri--) {
                if (!styleSheet.rules[ri].selectorText) continue;

                if (styleSheet.rules[ri].selectorText.match(':hover')) {
                    styleSheet.deleteRule(ri);
                }
            }
        }
    } catch (ex) {}
}
/*
	Sets all metatags based on a given object as defaultmetas
	The relevant here is title, image and description
*/
function setMetatags( metatags ){
	if(!metatags.title) metatags.title = defaultmetas.title;
	if(!metatags.image) metatags.image = defaultmetas.image;
	if(!metatags.description) metatags.description = defaultmetas.description;
	// title
	document.title = metatags.title;
	$("title").attr("title", metatags.title);
	$('[property="og\\:title"]').attr("content", metatags.title);
	$('[property="twitter\\:image:alt"]').attr("content", metatags.title);
	// description
	$('[name="description"]').attr("content", metatags.description);
	$('[property="og\\:description"]').attr("content", metatags.description);
	// image
	$('[name="image"]').attr("content", metatags.image);
	$('[property="og\\:image"]').attr("content", metatags.image);
	$('[property="twitter\\:card"]').attr("content", metatags.image);
	// url
	$('[property="og\\:url"]').attr("content", window.location.href);
}
/*
	Reset all metatags to the defaultmetas
*/
function resetMetatags(){
	return setMetatags(defaultmetas);
}
/*
	GLOBAL SWIPER INDEPENDENT INSTANCES
*/
function newSwiper( elem, customOptions ){
	if( typeof Swiper !== 'undefined'){
		$( elem ).each(function(index, element){
		    $(this).addClass('apsw-'+index);
		    new Swiper('.apsw-'+index, Object.assign({
				slidesPerView: 'auto',
				mode: 'horizontal',
				breakpoints: {
			        768: {
			          slidesPerView: 'auto',
			          centeredSlides: true,
			        },
				},
				grabCursor: true,
				navigation: {
					nextEl: $(this).find('.arrow-next'),
					prevEl: $(this).find('.arrow-prev'),
				}}, customOptions)
			);
		});
	}
}