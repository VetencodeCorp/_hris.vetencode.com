$(document).on('keyup', '#phone', function(){
	if (/\D/g.test(this.value)){
    	this.value = this.value.replace(/\D/g, '');
  	}
});

$(document).on('click', '#btn-login', function(){
	var url = $('#form-login').data('url'); 
	var href = $(this).data('href');
	var phone = $('#phone').val();
	var password = $('#password').val();
	
	if(phone == ''){
		$('#phone').focus();
  		M.toast({html: '<span>No. HP Wajib Diisi !</span>'});
	} else if(password == ''){
		$('#password').focus();
		M.toast({html: '<span>Password Wajib Diisi !</span>'});
	} else{
		$.ajax({
			url: url, 
			type: 'post', 
			data: {phone: phone, password: password}, 
			success: function(response){
				if(response == 'failed'){
					M.toast({html: '<span>Maaf ! No. HP atau Password Salah</span>'});
				} else{
					$('#btn-login').attr('disabled', true);
					M.toast({html: '<span>Mohon Tunggu Sebentar !</span>'});
					
					setTimeout(function() {
						window.location.href = href;
					}, 2000);
				}
			}
		});
	}
});

$('body').bind('keypress',function (event){ 
	if (event.keyCode === 13){		
   		$("#btn-login").trigger('click');
  	}
});