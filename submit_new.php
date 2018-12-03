<?php
require ("config/database.php");
require ("class/library.class.php");
$app = new DemoLib();
$database = db_camagru();
$password = $_POST['new_pass'];
$email = $_POST['email'];
$hash = hash('sha256',$password);
if ($app->password_check($password) == false)
{
  $query = $database->prepare("UPDATE db_camagru.users SET password=:hash WHERE email=:email");
  $query->bindParam(":hash", $hash, PDO::PARAM_STR);
  $query->bindParam(":email", $email, PDO::PARAM_STR);
  if ($res = $query->execute())
  {
    echo "<script> alert ('Your password has been changed')</script>";
    header("refresh:0.01; url=login.php");
  }
}
else
{
  echo "<script> alert ('password must contain at least one number, at least one letter, at least one special character and  there have to be 8-12 characters')</script>";
  header("refresh:0.01; url=reset_password.php");
}

 ?>
