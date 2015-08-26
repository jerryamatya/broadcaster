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

	$(".epg-body").on('click','.rm-prgm',function(e){
		e.preventDefault();
		var rm = $(this).parent().parent();

		rm.fadeOut("normal", function() {
        	$(this).remove();
    	});
	});

})(jQuery);