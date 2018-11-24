// (function()
// {
document.getElementById('save').addEventListener('click', function() {
	//convert image to url and save as png
	var canvas = document.getElementById("canvas");
	var dataUrl = canvas.toDataURL("image/png");

	var json = {
		image: dataUrl
	}

	var xhr = new XMLHttpRequest();
	xhr.open('POST', '../webcam/save_image.php', true);
	xhr.setRequestHeader('Content-type', 'application/json');
	xhr.onreadystatechange = function(data) {
		if (xhr.readyState == 4 && xhr.status == 200) {
			console.log('Success');
		}
	}
	xhr.send(JSON.stringify(json))

});
