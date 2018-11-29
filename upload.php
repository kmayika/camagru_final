<?php
session_start();
require ('class/library.class.php');
$app = new DemoLib();
if (isset($_POST['submit']) && !empty($_FILES['image']['name']) AND isset($_SESSION['id']))
{
  $user_id = $_SESSION['id'];
	$image = $_FILES['image']['name'];
	$path = "upload/" . basename($image);
	$insert_id = $app->pic_upload($image,$user_id);
  if (!empty($insert_id))
  {
    if (move_uploaded_file($_FILES['image']['tmp_name'], $path))
		{
			$message = 'image uploaded to profile';
      echo "<script> alert('$message')</script>";
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
