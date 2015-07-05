<<<<<<< HEAD
(function($){
	var panelCount = 1;
	$("#newsource").click(function(e){
		e.preventDefault();
		var panel = $("#newsourcepanel .panel");
		panel.find('.panel-title a').attr('href',"#panel"+panelCount);
		panel.find('.panel-collapse').attr('id',"panel"+panelCount);
		panel.clone().prependTo("#accordion");
		panelCount++;

		if($('#accrodion').children().length == 0){
			$('.savesourcesouter').removeClass('hide');
		}
	});
	$(".editsource").click(function(){
		var id = $(this).data('id'),
			collapsable = $("#collapseOne"+id);

		collapsable.collapse('show');
		collapsable.find('input').eq(0).focus();
	});
})(jQuery);
=======
(function($){
	var panelCount = 1;
	$("#newsource").click(function(e){
		e.preventDefault();
		var panel = $("#newsourcepanel .panel");
		panel.find('.panel-title a').attr('href',"#panel"+panelCount);
		panel.find('.panel-collapse').attr('id',"panel"+panelCount);
		panel.clone().prependTo("#accordion");
		panelCount++;

		if($('#accrodion').children().length == 0){
			$('.savesourcesouter').removeClass('hide');
		}
	});
	$(".editsource").click(function(){
		var id = $(this).data('id'),
			collapsable = $("#collapseOne"+id);

		collapsable.collapse('show');
		collapsable.find('input').eq(0).focus();
	});
})(jQuery);
>>>>>>> 22be403ff560b2bebfd1c48a952bcdee7ef708da
