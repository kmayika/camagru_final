<?php
  session_start();
  require_once("../config/database.php");
  // $image = $_POST['image'];
  $image = $_SESSION['image'];
  $database = db_camagru();
  $query = $database->prepare("SELECT * FROM db_camagru.images WHERE image=:image");
  $query->bindValue(":image",$image);
  $query->execute();
  // $row = $query->fetchAll();
  echo "<img src='../upload/{$image}'/>";
  echo $_SESSION['im'];
 ?>
