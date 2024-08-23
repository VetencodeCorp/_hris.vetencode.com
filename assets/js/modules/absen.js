Webcam.set({
	width: 320,
	height: 240,
	image_format: 'jpeg',
	jpeg_quality: 90
});
Webcam.attach('#my_camera');

$(document).on('click', '#btn-foto', function(){ 
	$('#wrap-note').hide();
	Webcam.freeze();
	document.getElementById('pre_take_buttons').style.display = 'none';
	document.getElementById('post_take_buttons').style.display = '';
});

$(document).on('click', '#btn-refoto', function(){
	Webcam.unfreeze();

	document.getElementById('pre_take_buttons').style.display = '';
	document.getElementById('post_take_buttons').style.display = 'none';
});

$(document).on('click', '#btn-absen', function(){
	var url = $(this).data('url');
	var href = $(this).data('href');
	Webcam.snap( function(data_uri) {
		Webcam.upload(data_uri, url, function(code, text){
	    	if (code == '200') {
	    		$('#btn-take-foto').attr('disabled', true);
	        	M.toast({html: '<span>Absen Sukses !</span>'});
						
				setTimeout(function() {
					window.location.href = href;
				}, 2000); 
	        } else {
	        	M.toast({html: '<span>Absen Gagal !</span>'});
	        }
	    });			
	});
});
