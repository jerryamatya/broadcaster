<<<<<<< HEAD
(function($){
	"use strict"
	var deleteroute ="";
	$(".deletenewsapp").click(function(e){

		e.preventDefault();

		deleteroute = $(this).attr('href');
		var modal = $(".modal");
		modal.find('.modal-title').html("News App : delete");
		modal.find('.modal-body').html('Are you sure to delete?');
		modal.modal();
	});

	$(".confirmyes").click(function(){
		if(deleteroute){
			window.location.href = deleteroute;
		}
	});

=======
(function($){
	"use strict"
	var deleteroute ="";
	$(".deletenewsapp").click(function(e){

		e.preventDefault();

		deleteroute = $(this).attr('href');
		var modal = $(".modal");
		modal.find('.modal-title').html("News App : delete");
		modal.find('.modal-body').html('Are you sure to delete?');
		modal.modal();
	});

	$(".confirmyes").click(function(){
		if(deleteroute){
			window.location.href = deleteroute;
		}
	});

>>>>>>> 22be403ff560b2bebfd1c48a952bcdee7ef708da
})(jQuery);