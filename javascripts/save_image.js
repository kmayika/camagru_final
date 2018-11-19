// (function()
// {
  document.getElementById('save').addEventListener('click', function()
  {
  //convert image to url and save as png
  var canvas = document.getElementById("canvas");
  var dataUrl = canvas.toDataURL("image/png");
  //use ajax post to connect to php
//   $.ajax(
//     {
//       type: "POST",
//       url: "../webcam/save_image.php",
//       data: {image: dataUrl}
//     })
//     .done(function(respond){console.log("done: "+respond);})
//     .fail(function(respond){console.log("fail");})
//     .always(function(respond){console.log("always");})
// })

    var ajax = new XMLHttpRequest(),
    			 params="image="+dataUrl;

		ajax.open("POST", "../webcam/save_image.php", true);
		ajax.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		ajax.onreadystatechange = function()
		{
		    if (this.readyState == 4 && this.status == 200){
				 console.log("Success");
			 }
		};
		ajax.send(params);

});
// )();
