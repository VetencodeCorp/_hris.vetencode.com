(function(){
	var modalElement = document.getElementById('history-detail-modal');
	if(!modalElement){
		return;
	}

	function setPhoto(frameId, imageId, source){
		var frame = document.getElementById(frameId);
		var image = document.getElementById(imageId);

		if(source){
			image.src = source;
			frame.classList.add('has-photo');
		} else {
			image.removeAttribute('src');
			frame.classList.remove('has-photo');
		}
	}

	document.addEventListener('click', function(event){
		var button = event.target.closest('.history-detail-button');
		if(!button){
			return;
		}

		document.getElementById('history-modal-title').textContent = button.dataset.name;
		document.getElementById('history-modal-date').textContent = button.dataset.date;
		document.getElementById('history-modal-in-time').textContent = button.dataset.inTime;
		document.getElementById('history-modal-out-time').textContent = button.dataset.outTime;
		document.getElementById('history-modal-status').textContent = button.dataset.status;
		document.getElementById('history-modal-note').textContent = button.dataset.note;

		setPhoto('history-photo-in-frame', 'history-photo-in', button.dataset.photoIn);
		setPhoto('history-photo-out-frame', 'history-photo-out', button.dataset.photoOut);

		var modal = M.Modal.getInstance(modalElement) || M.Modal.init(modalElement, {
			dismissible: true,
			opacity: 0.72
		});
		modal.open();
	});
})();
