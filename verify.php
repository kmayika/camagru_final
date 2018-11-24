<?php
session_start();
  require ('config/database.php');
  if (isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash']))
  {
    $database = db_camagru();
    $email = $_GET['email'];
    $hash = $_GET['hash'];
    $query = $database->prepare("SELECT email, hash, active FROM db_camagru.users WHERE email=:email AND hash=:hash AND active='0'");
    $query->bindValue(":email", $email);
    $query->bindValue(":hash", $hash);
    $query->execute();
    $row = $query->fetchColumn();
    $row_no = count($row);
    if ($row_no > 0)
    {
        $query = $database->prepare("UPDATE db_camagru.users SET active='1' WHERE email='".$email."' AND hash='".$hash."' AND active='0'");
        $query->bindValue(":email", $email);
        $query->bindValue(":hash", $hash);
        $query->execute();
        echo '<script> alert ("Your account has been activated, you can now login")</script>';
        header("refresh:0.01; url=login.php");
    }
    else
    {
      echo '<script> alert ("Your account has not been activated")</script>';
    }
  }
  else {
    echo '<script> alert ("Please use link sent to email")</script>';
  }
 ?>
