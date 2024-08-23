$(document).on('keyup', '#phone', function(){
	if (/\D/g.test(this.value)){
    	this.value = this.value.replace(/\D/g, '');
  	}
});

$(document).on('click', '#btn-update', function(){
	var url = $('#form-edit').data('url');
	var href = $('#form-edit').data('href');
	var fullname = $('#fullname').val();
	var phone = $('#phone').val();
	var password = $('#password').val();
	var passconf = $('#passconf').val();
	if(fullname == ''){
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
				url: url, 
				type: 'POST', 
				data: {fullname: fullname, phone: phone, password: passconf}, 
				success: function(response){
					$('#btn-update').attr('disabled', true);
					M.toast({html: '<span>Edit Profile Sukses !</span>'});
					
					setTimeout(function() {
						window.location.href = href;
					}, 2000);
				}
			});
		}
	} else{
		$.ajax({
			url: url, 
			type: 'POST', 
			data: {fullname: fullname, phone: phone, password: passconf}, 
			success: function(response){
				$('#btn-update').attr('disabled', true);
				M.toast({html: '<span>Edit Profile Sukses !</span>'});
				
				setTimeout(function() {
					window.location.href = href;
				}, 2000);
			}
		});
	}
});
