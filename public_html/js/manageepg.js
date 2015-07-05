<<<<<<< HEAD
(function($){
	$(".addprgm").click(function(e){
		e.preventDefault();
		var holder = $(this).parent().parent().parent(),
			prgm = $('.hide .prgm'),
			day = $(this).data('day');
		prgm.find('.name').attr('name',"programs["+day+"][names][]");
		prgm.find('.start').attr('name',"programs["+day+"][starts][]");
		prgm.find('.end').attr('name',"programs["+day+"][ends][]");
		prgm.clone().appendTo(holder);
		holder.find('.prgm .clockpicker').clockpicker();



	});

})(jQuery);
=======
(function($){
	$(".addprgm").click(function(e){
		e.preventDefault();
		var holder = $(this).parent().parent().parent(),
			prgm = $('.hide .prgm'),
			day = $(this).data('day');
		prgm.find('.name').attr('name',"programs["+day+"][names][]");
		prgm.find('.start').attr('name',"programs["+day+"][starts][]");
		prgm.find('.end').attr('name',"programs["+day+"][ends][]");
		prgm.clone().appendTo(holder);
		holder.find('.prgm .clockpicker').clockpicker();



	});

})(jQuery);
>>>>>>> 22be403ff560b2bebfd1c48a952bcdee7ef708da
