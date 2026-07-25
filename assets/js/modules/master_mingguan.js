$(document).on('keyup', '#input-jumlah', function(){
	if (/\D/g.test(this.value)){
    	this.value = this.value.replace(/\D/g, '');
  	}
  	
  	var jumlah = $(this).val();
  	
  	$('#input-jumlah').val(parseFloat(jumlah).toLocaleString());
	$('#jumlah').val(jumlah);
});

$(document).on('click', '#btn-add', function(){
	var url = $('#form-add').data('url');
	var href = $('#form-add').data('href');
	var jumlah = $('#jumlah').val();

	$.ajax({
		url: url, 
		type: 'POST', 
		data: {jumlah: jumlah}, 
		success: function(response){
			if(response > 0){
				$('#btn-add').attr('disabled', true);
				M.toast({html: '<span>Add Data Sukses !</span>'});
				
				setTimeout(function() {
					window.location.href = href;
				}, 2000);
			} else{
				M.toast({html: '<span>Add Data Gagal !</span>'});
			}
			
		}
	});
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
	var jumlah = $('#jumlah').val();

	$.ajax({
		url: url, 
		type: 'POST', 
		data: {id: id, method: method, jumlah: jumlah}, 
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