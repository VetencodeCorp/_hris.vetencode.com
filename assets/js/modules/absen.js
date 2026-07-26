Webcam.set({
	width: 320,
	height: 240,
	image_format: 'jpeg',
	jpeg_quality: 90,
	flip_horiz: true,
	unfreeze_snap: false,
	constraints: {
		facingMode: 'user'
	}
});
Webcam.attach('#my_camera');

function freezeCameraWithoutStretch(){
	var video = Webcam.video;
	var container = document.getElementById('my_camera');

	if(!video || video.readyState < 2 || !video.videoWidth || !video.videoHeight){
		M.toast({html: '<span>Kamera belum siap. Tunggu sebentar lalu coba lagi.</span>'});
		return false;
	}

	if(Webcam.preview_active){
		Webcam.unfreeze();
	}

	var sourceWidth = video.videoWidth;
	var sourceHeight = video.videoHeight;
	var targetRatio = 3 / 4;
	var sourceRatio = sourceWidth / sourceHeight;
	var sx = 0;
	var sy = 0;
	var sw = sourceWidth;
	var sh = sourceHeight;

	// Crop frame to preview ratio. Never stretch source pixels.
	if(sourceRatio > targetRatio){
		sw = sourceHeight * targetRatio;
		sx = (sourceWidth - sw) / 2;
	} else if(sourceRatio < targetRatio){
		sh = sourceWidth / targetRatio;
		sy = (sourceHeight - sh) / 2;
	}

	var canvas = document.createElement('canvas');
	var outputWidth = 720;
	var outputHeight = Math.round(outputWidth / targetRatio);
	var context = canvas.getContext('2d');

	canvas.width = outputWidth;
	canvas.height = outputHeight;

	if(Webcam.params.flip_horiz){
		context.translate(outputWidth, 0);
		context.scale(-1, 1);
	}

	context.drawImage(video, sx, sy, sw, sh, 0, 0, outputWidth, outputHeight);

	Webcam.unflip();
	video.style.display = 'none';
	canvas.className = 'attendance-camera-preview';
	container.insertBefore(canvas, Webcam.peg);
	container.style.overflow = 'hidden';

	Webcam.preview_canvas = canvas;
	Webcam.preview_context = context;
	Webcam.preview_active = true;

	return true;
}

$(document).on('click', '#btn-foto', function(){
	$('#wrap-note').hide();

	if(!freezeCameraWithoutStretch()){
		return;
	}

	document.getElementById('pre_take_buttons').style.display = 'none';
	document.getElementById('post_take_buttons').style.display = '';
});

$(document).on('click', '#btn-refoto', function(){
	Webcam.unfreeze();
	Webcam.video.style.display = 'block';

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
