$('#user_id').select2();

$(document).on('change', '#user_id', function(){
	var url = $(this).data('url'); 
	var user_id = $(this).val();
		
	$.ajax({
		url: url, 
		type: 'POST', 
		data: {user_id: user_id}, 
		cache: false, 
		dataType: 'json', 
		success: function(response){
			$('#label-insentif').addClass('active');
			$('#label-hadir').addClass('active');
			$('#label-jumlah').addClass('active');
			$('#input-insentif').val(response.input_mingguan);
			$('#insentif').val(response.mingguan);
			$('#hadir').val(response.hadir);
			
			if(response.access_id == 4){
				$('#hadir').val(1);
			} 
			
			var insentif = $('#insentif').val();
			var hadir = $('#hadir').val();
			
			var jumlah = insentif * hadir;
	
			$('#input-jumlah').val(parseFloat(jumlah).toLocaleString());
			$('#jumlah').val(jumlah);
		}
	});
});



$(document).on('click', '#btn-add', function(){
	var url = $('#form-add').data('url'); 
	var href = $('#form-add').data('href'); 
	var user_id = $('#user_id').val();
	var insentif = $('#insentif').val();
	var hadir = $('#hadir').val();
	var jumlah = $('#jumlah').val();
	
	if(user_id == null){
		M.toast({html: '<span>Pegawai Wajib Dipilih !</span>'});
	} else{
		$.ajax({
			url: url, 
			type: 'POST', 
			data: {user_id: user_id, insentif: insentif, hadir: hadir, jumlah: jumlah}, 
			success: function(response){
				if(response > 0){
					$('#btn-add').addClass('disabled', true);
					M.toast({html: '<span>Add Data Sukses !</span>'});
									
					setTimeout(function() {
						window.location.href = href;
					}, 2000);
				} else{
					M.toast({html: '<span>Add Data Gagal !</span>'});
				}
			}
		});
	}
});

$(document).on('click', '.btn-delete', function(){
	var url = $(this).data('url'); 
	var href = $(this).data('href'); 
	var id = $(this).data('id');
	
	$.ajax({
		url: url, 
		type: 'POST', 
		data: {id: id}, 
		success: function(response){
			$('#modal-delete').modal('open');
			$('#modal-delete').html(response);
		}
	});
});

$(document).on('click', '#btn-submit-delete', function(){
	var url = $(this).data('url'); 
	var href = $(this).data('href'); 
	
	$.ajax({
		url: url, 
		type: 'POST', 
		success: function(response){
			if(response > 0){
				$('#btn-submit-delete').addClass('disabled', true);
				M.toast({html: '<span>Delete Data Sukses !</span>'});
								
				setTimeout(function() {
					window.location.href = href;
				}, 2000);
			} else{
				M.toast({html: '<span>Delete Data Gagal !</span>'});
			}
		}
	});
});
