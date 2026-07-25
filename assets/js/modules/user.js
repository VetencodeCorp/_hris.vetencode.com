$('#akses_id').select2();

$(document).on('keyup', '#phone', function(){
	if (/\D/g.test(this.value)){
    	this.value = this.value.replace(/\D/g, '');
  	}
});

$(document).on('keyup', '#input-gapok', function(){
	if (/\D/g.test(this.value)){
    	this.value = this.value.replace(/\D/g, '');
  	}
  	
  	var gapok = $(this).val();
  	
  	$('#input-gapok').val(parseFloat(gapok).toLocaleString());
	$('#gapok').val(gapok);
});

$(document).on('keyup', '#input-mingguan', function(){
	if (/\D/g.test(this.value)){
    	this.value = this.value.replace(/\D/g, '');
  	}
  	
  	var mingguan = $(this).val();
  	
  	$('#input-mingguan').val(parseFloat(mingguan).toLocaleString());
	$('#mingguan').val(mingguan);
});

$(document).on('click', '#btn-add', function(){
	var url = $('#form-add').data('url');
	var url_check_phone = $('#phone').data('url');
	var href = $('#form-add').data('href');
	
	var access_id = $('#akses_id').val();
	var fullname = $('#fullname').val();
	var phone = $('#phone').val();
	var password = $('#password').val();
	var passconf = $('#passconf').val();
	var gapok = $('#gapok').val();
	var mingguan = $('#mingguan').val();
	
	if(access_id == null){
		M.toast({html: '<span>Akses Wajib Dipilih !</span>'});
	} else if(fullname == ''){
		$('#fullname').focus();
  		M.toast({html: '<span>Nama Wajib Diisi !</span>'});
	} else if(phone == ''){
		$('#phone').focus();
  		M.toast({html: '<span>No. HP Wajib Diisi !</span>'});
	} else if(password == ''){
		$('#password').focus();
  		M.toast({html: '<span>Password Wajib Diisi !</span>'});
	} else if(password !== passconf){
		M.toast({html: '<span>Password Tidak Sama !</span>'});
	} else{
		$.ajax({
			url: url_check_phone, 
			type: 'POST', 
			data: {phone: phone}, 
			success: function(response){
				if(response > 0){
					M.toast({html: '<span>Maaf No. HP Sudah Terdaftar !</span>'});
				} else{
					$.ajax({
						url: url, 
						type: 'POST', 
						data: {access_id: access_id, fullname: fullname, phone: phone, password: passconf, gapok: gapok, mingguan: mingguan}, 
						success: function(response){
							if(response > 0){
								$('#btn-add').attr('disabled', true);
								M.toast({html: '<span>Add User Sukses !</span>'});
								
								setTimeout(function() {
									window.location.href = href;
								}, 2000);
							}
						}
					});
				}
			}
		});
	}
});

$(document).on('click', '#btn-update', function(){
	var url = $('#form-update').data('url');
	var url_check_phone = $('#phone').data('url');
	var href = $('#form-update').data('href');
	
	var access_id = $('#akses_id').val();
	var fullname = $('#fullname').val();
	var phone = $('#phone').val();
	var password = $('#password').val();
	var passconf = $('#passconf').val(); 
	var gapok = $('#gapok').val();
	var mingguan = $('#mingguan').val();
	
	if(access_id == null){
		M.toast({html: '<span>Akses Wajib Dipilih !</span>'});
	} else if(fullname == ''){
		$('#fullname').focus();
  		M.toast({html: '<span>Nama Wajib Diisi !</span>'});
	} else if(phone == ''){
		$('#phone').focus();
  		M.toast({html: '<span>No. HP Wajib Diisi !</span>'});
	} else if(password !== ''){
		if(password !== passconf){
			M.toast({html: '<span>Password Tidak Sama !</span>'});
		} else{
			$.ajax({
				url: url_check_phone, 
				type: 'POST', 
				data: {phone: phone}, 
				success: function(response){
					if(response > 0){
						M.toast({html: '<span>Maaf No. HP Sudah Terdaftar !</span>'});
					} else{
						$.ajax({
							url: url, 
							type: 'POST', 
							data: {access_id: access_id, fullname: fullname, phone: phone, password: passconf, gapok: gapok, mingguan: mingguan}, 
							success: function(response){
								$('#btn-update').attr('disabled', true);
								M.toast({html: '<span>Edit User Sukses !</span>'});
								
								setTimeout(function() {
									window.location.href = href;
								}, 2000);
							}
						});
					}
				}
			});
		}
	} else{
		$.ajax({
			url: url_check_phone, 
			type: 'POST', 
			data: {phone: phone}, 
			success: function(response){ 
				if(response > 0){
					M.toast({html: '<span>Maaf No. HP Sudah Terdaftar !</span>'});
				} else{
					$.ajax({
						url: url, 
						type: 'POST', 
						data: {access_id: access_id, fullname: fullname, phone: phone, gapok: gapok, mingguan: mingguan}, 
						success: function(response){
							$('#btn-update').attr('disabled', true);
							M.toast({html: '<span>Edit User Sukses !</span>'});
							
							setTimeout(function() {
								window.location.href = href;
							}, 2000);
						}
					});
				}
			}
		});
	}
});

$(document).on('click', '.btn-alert', function(){
	var url = $(this).data('url');
	var method = $(this).data('method');
	var id = $(this).data('id');
	
	$.ajax({
		url: url, 
		type: 'POST', 
		data: {id: id, method: method}, 
		success: function(response){
			$('#modal-alert').modal('open');
			$('#modal-alert').html(response);
		}
	});
});

$(document).on('click', '#btn-submit-alert', function(){
	var url = $('#form-alert').data('url');
	var href = $('#form-alert').data('href');
	var method = $('#method').val();
	var id = $('#akses_id').val();

	$.ajax({
		url: url, 
		type: 'POST', 
		data: {id: id, method: method}, 
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