	function openModal(route, title, body, modal){
		modal = modal || $(".modal");
		modal.find('.modal-title').html(title);
		modal.find('.modal-body').html(body);
		modal.modal();

		$(".confirmyes").click(function(){
			confirmDelete(modal, route);
		});
	}
	function openchanneldeletemodal(e, self){
		e.preventDefault();
		var route = self.attr('href');
		openModal(route, "Channel: delete","Are you sure you want to delete this channel?");
	}
	function confirmDelete(modal, route){
		if(route){
			if(modal){
				modal.modal('hide');
			}
			window.location.href = route;
		}