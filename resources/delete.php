<?php

session_start();
require ("../config/database.php");

if (isset($_GET['id']))
{
  $database = db_camagru();
  $user_id = $_GET['id'];
  $query = $database->prepare("DELETE FROM db_camagru.images WHERE id=:user_id");
  $query->bindParam(":user_id", $user_id, PDO::PARAM_STR);
  $query->execute();
  $query = $database->prepare("DELETE FROM db_camagru.comment WHERE post_id=:user_id");
  $query->bindParam(":user_id", $user_id, PDO::PARAM_STR);
  $query->execute();
  echo "<script> alert ('deleted')</script>";
  header("refresh: 0.01; url=../profile/profile.php");
}
?>
