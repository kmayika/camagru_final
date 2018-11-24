//self invoking funct
(function() {
	var video = document.getElementById('video'),
		canvas = document.getElementById('canvas'),
		context = canvas.getContext('2d'),
		vendorUrl = window.URL || window.webkitURL;


	navigator.getMedia = navigator.getUserMedia ||
		navigator.wekitGetUserMedia ||
		//mozilla
		navigator.mozGetUserMedia ||
		//micro soft
		navigator.msGetUserMedia;

	navigator.getMedia({
			video: true,
			audio: false
		},
		function(stream) {
			try {
				video.srcObject = stream;
			} catch (error) {
				video.src = window.URL.createObjectURL(stream);
			}
			video.play();
			streaming = true;
		},
		function(error) {
			console.log(error);
		});

	document.getElementById('capture').addEventListener('click', function() {
		canvas.width = video.videoWidth;
		canvas.height = video.videoHeight;
		context.drawImage(video, 0, 0, canvas.width, canvas.height);
	});


})();
