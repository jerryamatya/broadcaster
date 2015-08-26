(function($){
	$(".addnoti").click(function(e){
		e.preventDefault();
		var holder = $('.noti-body');
			noti = $('.hide .notification_clone'),
			nextindex = 0;
		var notiholders = holder.find('.single');
		if(notiholders.length){
			nextindex = notiholders.last().data('index')+1;
		}
		
		noti.find('.single').attr('data-index',nextindex);
		noti.find('.single').last().data('index')+1;
		noti.find('.msg').attr('name',"notifications["+nextindex+"][msg]");
		noti.find('.id').attr('name',"notifications["+nextindex+"][id]");
		noti.find('.type').attr('name',"notifications["+nextindex+"][type]");
		noti.find('.data').attr('name',"notifications["+nextindex+"][data]");
		noti.find('.time').attr('name',"notifications["+nextindex+"][time]");
		noti.clone().appendTo(holder);
		holder.find('.clockpicker').clockpicker();
		$('.submit').removeClass('hide');
	});

	$(".noti-body").on('click','.rm-noti',function(e){
		e.preventDefault();
		var rm = $(this).parent();
		var index = rm.data('index');
		rm.fadeOut("normal", function() {
        		$(this).addClass('hide');
        		$(this).prepend("<input type='hidden' name='notifications["+index+"][remove]'/>");
        		var notiholders = $(".noti-body").find('.single');
        		if(notiholders.length==0){
        			$('.submit').addClass('hide');
        		}
    	});
	});
})(jQuery);