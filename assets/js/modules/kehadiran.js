$(document).on('change', '.btn-flag', function(){
	var url = $(this).data('url');
	var href = $(this).data('href');
	var flag = $(this).val();

	$.ajax({
		url: url, 
		type: 'POST', 
		data: {flag: flag}, 
		success: function(response){
			if(response > 0){
				$('.btn-flag').attr('disabled', true);
				M.toast({html: '<span>Edit Data Sukses !</span>'});
				
				setTimeout(function() {
					window.location.href = href;
				}, 2000);
			} else{
				M.toast({html: '<span>Edit Data Gagal !</span>'});
			}
		}
	});
});

$(document).on('click', '.btn-alert', function(){
	var url = $(this).data('url');
	var href = $(this).data('href');
	var method = $(this).data('method'); 
	var id = $(this).data('id');
	
	$.ajax({
		url: url, 
		type: 'POST', 
		data: {id: id, method: method}, 
		success: function(response){
			$('#modal-alert').html(response);
			$('#modal-alert').modal('open');
		},
		error: function(){
			M.toast({html: '<span>Dialog aksi gagal dimuat.</span>'});
		}
	});
});

$(document).on('click', '#btn-submit-alert', function(){
	var url = $('#form-alert').data('url');
	var href = $('#form-alert').data('href');
	var method = $('#method').val(); 
	var id = $('#id').val(); 
	var note = $('#note').val();

	$.ajax({
		url: url, 
		type: 'POST', 
		data: {id: id, method: method, note: note}, 
		success: function(response){
			if(response > 0){
				$('#btn-submit-alert').attr('disabled', true);
				M.toast({html: '<span>'+method+' Data Sukses !</span>'});
				
				setTimeout(function() {
					window.location.href = href;
				}, 2000);
			} else{
				M.toast({html: '<span>'+method+' Data Gagal !</span>'});
			}
		}
	});
});

$(document).on('click', '.btn-keterangan', function(){
	var url = $(this).data('url');
	var href = $(this).data('href');
	var method = $(this).data('method'); 
	
	$.ajax({
		url: url, 
		type: 'POST', 
		data: {method: method}, 
		success: function(response){
			$('#modal-alert').modal('open');
			$('#modal-alert').html(response);
		}
	});
});

$(document).on('click', '#btn-submit-keterangan', function(){
	var url = $('#form-alert').data('url');
	var href = $('#form-alert').data('href');
	var method = $('#method').val(); 
	var id = $('#id').val();
	
	$.ajax({
		url: url, 
		type: 'POST', 
		data: {id: id, method: method}, 
		success: function(response){
			if(response > 0){
				$('#btn-submit-keterangan').attr('disabled', true);
				M.toast({html: '<span>Edit Data Sukses !</span>'});
				
				setTimeout(function() {
					window.location.href = href;
				}, 2000);
			} else{
				M.toast({html: '<span>Edit Data Gagal !</span>'});
			}
		}
	});
});

$(document).on('click', '.btn-absen', function(){
	var url = $(this).data('url');
	
	$.ajax({
		url: url, 
		success: function(response){
			$('#modal-alert').modal('open');
			$('#modal-alert').html(response);
		}
	});
});

$(document).on('click', '.btn-edit-flag', function(){
	var url = $(this).data('url');
	
	$.ajax({
		url: url, 
		success: function(response){
			$('#modal-alert').modal('open');
			$('#modal-alert').html(response);
		}
	});
});

$(document).on('click', '#btn-edit-flag', function(){
	var url = $('#form-edit-flag').data('url');
	var href = $('#form-edit-flag').data('href');
	var flag = $('#edit-flag').val(); 
	var id = $('#id').val();
	
	$.ajax({
		url: url, 
		type: 'POST', 
		data: {id: id, flag: flag}, 
		success: function(response){
			if(response > 0){
				$('#btn-edit-flag').attr('disabled', true);
				M.toast({html: '<span>Edit Data Sukses !</span>'});
				
				setTimeout(function() {
					window.location.href = href;
				}, 2000);
			} else{
				M.toast({html: '<span>Edit Data Gagal !</span>'});
			}
		}
	});
});
