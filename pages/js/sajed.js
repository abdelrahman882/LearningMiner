$(document).ready(function() {

	//this is used to collapse the drop slider for more information in the welcoming page
	$("#nbar").on("click", function(){
	$("#slider").slideToggle();
	$(this).fadeOut(100);
	$("#nbar2").slideToggle(750);
	});
	
	$("#nbar2").on("click", function(){
	$("#slider").slideToggle();
	$("#nbar").fadeIn(500);
	$("#nbar2").slideToggle(750);
	});
	
	
});