<?php
session_start();
require ('library/library.php');
$app = new DemoLib();
if (isset($_POST['submit']) && !empty($_FILES['image']['name']))
{
  $user_id = $_SESSION['id'];
  //get all submitted data
		$image = $_FILES['image']['name'];
		//path to store the uplaoded imagearc
		$path = "upload/" . basename($image);
		//upload to database
		$insert_id = $app->pic_upload($image,$user_id);
		//now let's move uploaded images
    if (!empty($insert_id))
    {
      if (move_uploaded_file($_FILES['image']['tmp_name'], $path))
  		{
  			$message = 'image uploaded to profile';
        echo "<script> alert('$message')</script>";
        // echo "<script>setTimeout(\"location.href = '../webcam/cam.php';\", 1000);</script>";
        header("refresh:0.01; url=template.php");
  		}
  		else
      {
  			$message = "There was a problem uploading this image";
        echo "<script> alert('$message')</script>";
        exit;
  		}
    }
	}
  else
  {
    $message = 'Please choose pic';
    echo "<script> alert('$message')</script>";
    header("refresh:0.01; url=webcam/cam.php");
  }
?>
