(function(){

/* 
	datemask intialize
*/
$('[data-mask]').inputmask()

/* 
	workaround to use checkbox out of ajax on cake
	this keeps the checkbox value state binded with checked prop
*/
$('[type="checkbox"]').on("change", function(){
	$(this)[0].checked ? $(this).val("1") : $(this).val("0")
});

/*
	bind one input key up data to another
*/
$(".data-bind").each(function(){
	var target = $(this).attr("data-bind");
	$(this).on("keyup", function(e){
		$("."+target).val( $(this).val() );
	});
});

/*
	datatables. this is the default datatables
	configuration for all list tables in admin.
	default of 50 rows per page.
*/
$('.datatable').DataTable({
	displayLength: 50
});

})();