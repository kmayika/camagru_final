window.addEventListener("load", function() {
	var canvas = document.getElementById('canvas');
	var context = canvas.getContext('2d');
	var context1 = canvas.getContext('2d');
	var context2 = canvas.getContext('2d');
	var centerX = canvas.width / 2;
	var centerY = canvas.height / 2;

	var x = centerX;
	var y = centerY;
	var imageObj = new Image();
	document.getElementById('edit').addEventListener('click', function() {
		var imagesArray = ["../photos/frame4.png", "../photos/frame3.png", "../photos/frame1.png", "../photos/frame5.png", "../photos/mario.png", "../photos/hearts.png", "../photos/cat-PNG.png"];
		var num = Math.floor(Math.random() * 7);
		imageObj.src = imagesArray[num];
		imageObj.onload = function() {
			context.drawImage(imageObj, 0, 0, 640, 480);
		};
	});
});
